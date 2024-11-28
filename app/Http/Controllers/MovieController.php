<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use EasyRdf\Graph;
use EasyRdf\Sparql\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        $sparql = new Client('http://localhost:3030/movies/sparql');

        $queries = [
            'topRated' => "
                PREFIX film: <http://example.org/movie#>
                SELECT ?movie ?name ?image ?rating ?id
                WHERE {
                    ?movie a film:Movie ;
                        film:name ?name ;
                        film:rating ?rating ;
                        film:id ?id ;
                        film:image ?image .
                        FILTER(?rating != 'N/A')
                }
                ORDER BY DESC(?rating)
                LIMIT 10
            ",
            'action' => "
                PREFIX film: <http://example.org/movie#>
                SELECT ?movie ?name ?image ?rating ?id
                WHERE {
                    ?movie a film:Movie ;
                        film:name ?name ;
                        film:rating ?rating ;
                        film:image ?image ;
                        film:id ?id ;
                        film:genre 'Action' .
                        FILTER(?rating != 'N/A')
                }
                ORDER BY DESC(?rating)
                LIMIT 10
            ",
            'romance' => "
                PREFIX film: <http://example.org/movie#>
                SELECT ?movie ?name ?image ?rating ?id
                WHERE {
                    ?movie a film:Movie ;
                        film:name ?name ;
                        film:rating ?rating ;
                        film:image ?image ;
                        film:id ?id ;
                        film:genre 'Romance' .
                        FILTER(?rating != 'N/A')
                }
                ORDER BY DESC(?rating)
                LIMIT 10
            ",
            'drama' => "
                PREFIX film: <http://example.org/movie#>
                SELECT ?movie ?name ?image ?rating ?id
                WHERE {
                    ?movie a film:Movie ;
                        film:name ?name ;
                        film:rating ?rating ;
                        film:image ?image ;
                        film:id ?id ;
                        film:genre 'Drama' .
                        FILTER(?rating != 'N/A')
                }
                ORDER BY DESC(?rating)
                LIMIT 10
            ",
        ];

        $results = [];

        // Execute all queries and collect results
        foreach ($queries as $key => $query) {
            $sparqlResult = $sparql->query($query);

            $movies = [];
            foreach ($sparqlResult as $row) {
                $movies[] = [
                    'movie' => (string) $row->movie,
                    'name' => (string) $row->name,
                    'image' => (string) $row->image,
                    'rating' => (float) (string) $row->rating,
                    'id' => (string) $row->id,
                ];
            }
            $results[$key] = $movies;
        }

        // Pass results to the view
        return view('main.layout', [
            'topRatedMovies' => $results['topRated'],
            'actionMovies' => $results['action'],
            'romanceMovies' => $results['romance'],
            'dramaMovies' => $results['drama'],
        ]);
    }

    public function show($id)
    {
        $sparql = new Client('http://localhost:3030/movies/sparql'); // URL Fuseki SPARQL endpoint

        $query = "
        PREFIX ns1: <http://example.org/movie#>
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>

        SELECT ?movie ?name ?datePublished ?rating ?voters ?description ?award ?image ?language ?country ?trailer ?duration
        (GROUP_CONCAT(DISTINCT ?genre; separator=\", \") AS ?genres)
        (GROUP_CONCAT(DISTINCT ?actorUri; separator=\", \") AS ?actors)
        (GROUP_CONCAT(DISTINCT ?writerUri; separator=\", \") AS ?writers)
        (GROUP_CONCAT(DISTINCT ?directorUri; separator=\", \") AS ?directors)
        WHERE {
        ?movie rdf:type ns1:Movie ;
            ns1:id '$id' ;
            ns1:name ?name ;
            ns1:datePublished ?datePublished ;
            ns1:rating ?rating ;
            ns1:voters ?voters ;
            ns1:description ?description ;
            ns1:award ?award ;
            ns1:image ?image ;
            ns1:language ?language ;
            ns1:country ?country ;
            ns1:trailer ?trailer ;
            ns1:duration ?duration ;
            ns1:hasActor ?actorUri ;
            ns1:hasWriter ?writerUri ;
            ns1:director ?directorUri .
        OPTIONAL { ?movie ns1:genre ?genre . }
        }
        GROUP BY ?movie ?name ?datePublished ?rating ?voters ?description ?award ?image ?language ?country ?trailer ?duration
        ";
        try {
            $sparqlResult = $sparql->query($query);
        } catch (\Exception $e) {
            return response()->view('errors.query_error', ['error' => $e->getMessage()]);
        }

        $movie = null;
        $actorNames = [];
        $directorNames = [];
        $writerNames = [];

        foreach ($sparqlResult as $row) {
            $movie = [
                'name' => $this->validateString($row->name->getValue() ?? null, 'N/A'),
                'image' => $this->validateString($row->image instanceof \EasyRdf\Resource ? $row->image->getUri() : $row->image->getValue(), 'N/A'),
                'rating' => $this->validateFloat($row->rating->getValue() ?? null, 0.0),
                'description' => $this->validateString($row->description->getValue() ?? null, 'No description available.'),
                'trailer' => $this->validateString($row->trailer instanceof \EasyRdf\Resource ? $row->trailer->getUri() : $row->trailer->getValue(), ''),
                'datePublished' => $this->validateString($row->datePublished->getValue() ?? null, 'Unknown'),
                'voters' => $this->validateInt($row->voters->getValue() ?? null, 0),
                'award' => $this->validateString($row->award->getValue() ?? null, 'No awards.'),
                'id' => $id,
                'genres' => isset($row->genres) ? $this->validateArray(explode(', ', $row->genres->getValue()), []) : [],
                'language' => $this->validateString($row->language->getValue() ?? null, 'Unknown'),
                'country' => $this->validateString($row->country->getValue() ?? null, 'Unknown'),
                'writers' => isset($row->writers) ? $this->validateArray(explode(', ', $row->writers->getValue()), []) : [],
                'directors' => isset($row->directors) ? $this->validateArray(explode(', ', $row->directors->getValue()), []) : [],
                'actors' => isset($row->actors) ? $this->validateArray(explode(', ', $row->actors->getValue()), []) : [],
                'duration' => $this->validateString($row->duration->getValue() ?? null, 'Unknown duration'),
            ];

            // Proses Writers
            if (isset($row->writers)) {
                $writers = explode(', ', (string) $row->writers);
                foreach ($writers as $writerUri) {
                    if (strpos($writerUri, 'wikidata.org') !== false) {
                        // Query Wikidata untuk nama penulis
                        $wikidataQuery = "
                    PREFIX wd: <http://www.wikidata.org/entity/>
                    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

                    SELECT ?writerName
                    WHERE {
                        <{$writerUri}> rdfs:label ?writerName .
                        FILTER(LANG(?writerName) = 'en')
                    }";

                        $writerId = $this->extractIdFromUri($writerUri);
                        $wikidataClient = new Client('https://query.wikidata.org/sparql');
                        try {
                            $wikidataResult = $wikidataClient->query($wikidataQuery);
                            foreach ($wikidataResult as $writerRow) {
                                $writerNames[] = [
                                    'name' => $this->validateString((string) $writerRow->writerName, 'Unknown Writer'),
                                    'uri' => $writerId
                                ];
                            }
                        } catch (\Exception $e) {
                            $writerNames[] = 'Unknown Writer';
                        }
                    } else {
                        // Query Fuseki untuk URI penulis yang bukan Wikidata
                        $fusekiQuery = "
                    PREFIX film: <http://example.org/movie#>

                    SELECT ?writerName
                    WHERE {
                        <{$writerUri}> film:name ?writerName .
                    }";

                        try {
                            $fusekiResult = $sparql->query($fusekiQuery);
                            foreach ($fusekiResult as $writerRow) {
                                $writerNames[] = $this->validateString((string) $writerRow->writerName, 'Unknown Writer');
                            }
                        } catch (\Exception $e) {
                            $writerNames[] = ['name' => 'Unknown Actor', 'uri' => ''];
                        }
                    }
                }
            }

            // Proses Directors
            if (isset($row->directors)) {
                $directors = explode(', ', (string) $row->directors);
                foreach ($directors as $directorUri) {
                    if (strpos($directorUri, 'wikidata.org') !== false) {
                        // Query Wikidata untuk nama sutradara
                        $wikidataQuery = "
                    PREFIX wd: <http://www.wikidata.org/entity/>
                    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

                    SELECT ?directorName
                    WHERE {
                        <{$directorUri}> rdfs:label ?directorName .
                        FILTER(LANG(?directorName) = 'en')
                    }";

                        $directorId = $this->extractIdFromUri($directorUri);
                        $wikidataClient = new Client('https://query.wikidata.org/sparql');
                        try {
                            $wikidataResult = $wikidataClient->query($wikidataQuery);
                            foreach ($wikidataResult as $directorRow) {
                                $directorNames[] = [
                                    'name' => $this->validateString((string) $directorRow->directorName, 'Unknown Director'),
                                    'uri' => $directorId
                                ];
                            }
                        } catch (\Exception $e) {
                            $directorNames[] = ['name' => 'Unknown Actor', 'uri' => ''];
                        }
                    } else {
                        // Query Fuseki untuk URI sutradara yang bukan Wikidata
                        $fusekiQuery = "
                    PREFIX film: <http://example.org/movie#>

                    SELECT ?directorName
                    WHERE {
                        <{$directorUri}> film:name ?directorName .
                    }";

                        try {
                            $fusekiResult = $sparql->query($fusekiQuery);
                            foreach ($fusekiResult as $directorRow) {
                                $directorNames[] = $this->validateString((string) $directorRow->directorName, 'Unknown Director');
                            }
                        } catch (\Exception $e) {
                            $directorNames[] = 'Unknown Director';
                        }
                    }
                }
            }

            // Proses Actors
            if (isset($row->actors)) {
                $actors = explode(', ', (string) $row->actors);
                foreach ($actors as $actorUri) {
                    if (strpos($actorUri, 'wikidata.org') !== false) {
                        // Query Wikidata untuk nama aktor
                        $wikidataQuery = "
                    PREFIX wd: <http://www.wikidata.org/entity/>
                    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

                    SELECT ?actorName
                    WHERE {
                        <{$actorUri}> rdfs:label ?actorName .
                        FILTER(LANG(?actorName) = 'en')
                    }";
                        $actorId = $this->extractIdFromUri($actorUri);
                        $wikidataClient = new Client('https://query.wikidata.org/sparql');
                        try {
                            $wikidataResult = $wikidataClient->query($wikidataQuery);
                            foreach ($wikidataResult as $actorRow) {
                                $actorNames[] = [
                                    'name' => $this->validateString((string) $actorRow->actorName, 'Unknown Actor'),
                                    'uri' => $actorId // Store the URI of the actor
                                ];
                            }
                        } catch (\Exception $e) {
                            $actorNames[] = ['name' => 'Unknown Actor', 'uri' => ''];
                        }
                    } else {
                        // Query Fuseki untuk URI aktor yang bukan Wikidata
                        $fusekiQuery = "
                    PREFIX film: <http://example.org/movie#>

                    SELECT ?actorName
                    WHERE {
                        <{$actorUri}> film:name ?actorName .
                    }";

                        try {
                            $fusekiResult = $sparql->query($fusekiQuery);
                            foreach ($fusekiResult as $actorRow) {
                                $actorNames[] = $this->validateString((string) $actorRow->actorName, 'Unknown Actor');
                            }
                        } catch (\Exception $e) {
                            $actorNames[] = 'Unknown Actor';
                        }
                    }
                }
            }

            // Remove duplicates based on URI for actors
            $movie['actors'] = array_values(array_unique($actorNames, SORT_REGULAR));

            // Remove duplicates for directors and writers in the same way
            $movie['directors'] = array_values(array_unique($directorNames, SORT_REGULAR));
            $movie['writers'] = array_values(array_unique($writerNames, SORT_REGULAR));
        }

        if ($movie === null) {
            return response()->view('errors.no_movie_found', ['id' => $id]);
        }


        // Ambil daftar genre film yang sedang ditampilkan
        $genres = $movie['genres']; // Misalnya, ["Comedy", "Drama", "Fantasy"]

        // Buat bagian filter SPARQL berdasarkan genre
        $genreFilter = "";
        if (count($genres) > 1) {
            // Jika lebih dari 1 genre, cocokkan minimal 2 genre dengan tepat
            $genreConditions = [];
            foreach ($genres as $genre) {
                $genreConditions[] = "?genre = '$genre'";
            }
            // Kita akan memeriksa setidaknya 2 genre yang cocok
            $genreFilter = "FILTER(" . implode(" || ", $genreConditions) . ")";
        } elseif (count($genres) == 1) {
            // Jika hanya 1 genre, cocokkan genre tersebut
            $genreFilter = "FILTER(?genre = '" . $genres[0] . "')";
        }

        $querySimilarMovies = "
    PREFIX ns1: <http://example.org/movie#>
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>

    SELECT ?movie ?name ?image ?rating ?id
    WHERE {
        ?movie rdf:type ns1:Movie ;
               ns1:id ?id ;
               ns1:genre ?genre ;
               ns1:name ?name ;
               ns1:image ?image ;
               ns1:rating ?rating .
        FILTER(?id != \"$id\")  # Hindari film yang sedang ditampilkan
        $genreFilter  # Filter genre sesuai dengan film yang sedang ditampilkan
    }
    LIMIT 5
";

        try {
            $sparqlSimilarMovies = $sparql->query($querySimilarMovies);
            // dd($sparqlSimilarMovies);
            $similarMovies = [];
            foreach ($sparqlSimilarMovies as $row) {
                $similarMovies[] = [
                    'name' => $this->validateString($row->name instanceof \EasyRdf\Literal ? $row->name->getValue() : null, 'Unknown'),
                    'image' => $this->validateString($row->image instanceof \EasyRdf\Resource ? $row->image->getUri() : null, 'N/A'),
                    'rating' => $this->validateFloat($row->rating instanceof \EasyRdf\Literal ? $row->rating->getValue() : 0.0, 0.0),
                    'id' => $row->id instanceof \EasyRdf\Literal ? $row->id->getValue() : null,  // Ambil ID dari Literal
                ];
            }
        } catch (\Exception $e) {
            $similarMovies = [];
        }

        // Tambahkan similar movies ke data film
        $movie['similarMovies'] = $similarMovies;

        return view('show', compact('movie'));
    }

    private function extractIdFromUri($uri)
    {
        // Memisahkan URI untuk mengambil ID terakhir
        $parsedUri = parse_url($uri);
        $path = $parsedUri['path'] ?? '';
        return basename($path); // Mengambil bagian terakhir setelah '/'
    }

    public function getPersonDetails($id)
    {
        // SPARQL Query untuk mengambil data berdasarkan ID
        $sparqlQuery = "
        PREFIX wd: <http://www.wikidata.org/entity/>
        PREFIX wdt: <http://www.wikidata.org/prop/direct/>
        PREFIX schema: <http://schema.org/>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

        SELECT ?image ?name ?birthPlace ?birthDate ?deathDate ?occupationLabel ?countryLabel ?awardLabel ?description WHERE {
            BIND(wd:$id AS ?person)
            OPTIONAL { ?person wdt:P18 ?image. }
            OPTIONAL { ?person rdfs:label ?name. FILTER(LANG(?name) = 'en') }
            OPTIONAL { ?person wdt:P19 ?birthPlaceUri. ?birthPlaceUri rdfs:label ?birthPlace. FILTER(LANG(?birthPlace) = 'en') }
            OPTIONAL { ?person wdt:P569 ?birthDate. }
            OPTIONAL { ?person wdt:P570 ?deathDate. }
            OPTIONAL { ?person wdt:P106 ?occupationUri. ?occupationUri rdfs:label ?occupationLabel. FILTER(LANG(?occupationLabel) = 'en') }
            OPTIONAL { ?person wdt:P27 ?countryUri. ?countryUri rdfs:label ?countryLabel. FILTER(LANG(?countryLabel) = 'en') }
            OPTIONAL { ?person wdt:P166 ?awardUri. ?awardUri rdfs:label ?awardLabel. FILTER(LANG(?awardLabel) = 'en') }
            OPTIONAL { ?person schema:description ?description. FILTER(LANG(?description) = 'en') }
        }
        LIMIT 1
        ";

        // Client HTTP untuk SPARQL Endpoint
        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://query.wikidata.org/sparql',
            'timeout' => 10.0,
        ]);

        try {
            // Melakukan request ke SPARQL endpoint
            $response = $client->get('', [
                'query' => ['query' => $sparqlQuery, 'format' => 'json'],
            ]);

            $results = json_decode($response->getBody(), true)['results']['bindings'];

            if (!empty($results)) {
                $data = $results[0];

                // Format Data untuk View
                $personDetails = [
                    'image' => $data['image']['value'] ?? null,
                    'nama' => $data['name']['value'] ?? 'Unknown',
                    'tempatlahir' => $data['birthPlace']['value'] ?? 'Unknown',
                    'tanggallahir' => $data['birthDate']['value'] ?? 'Unknown',
                    'tanggalwafat' => $data['deathDate']['value'] ?? 'Unknown',
                    'pekerjaan' => $data['occupationLabel']['value'] ?? 'Unknown',
                    'country' => $data['countryLabel']['value'] ?? 'Unknown',
                    'award' => $data['awardLabel']['value'] ?? 'None',
                    'description' => $data['description']['value'] ?? 'No description available',
                ];

                return view('wikishow', compact('personDetails'));
            }

            return view('wikishow', [
                'personDetails' => null,
                'error' => 'No data found for the given ID.'
            ]);
        } catch (\Exception $e) {
            return view('wikishow', [
                'personDetails' => null,
                'error' => 'Error fetching data: ' . $e->getMessage()
            ]);
        }
    }

    private function validateString($value, $default)
    {
        return is_string($value) ? $value : $default;
    }

    private function validateFloat($value, $default)
    {
        return is_numeric($value) ? (float)$value : $default;
    }

    private function validateInt($value, $default)
    {
        return is_numeric($value) ? (int)$value : $default;
    }

    private function validateArray($value, $default)
    {
        return is_array($value) ? $value : $default;
    }

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'keywords' => 'required|string|max:255',
            'page' => 'nullable|integer|min:1', // Parameter opsional untuk halaman
        ]);

        // Ambil input keywords dan halaman (default ke 1 jika tidak ada)
        $keywords = htmlspecialchars($request->input('keywords'), ENT_QUOTES);
        $page = $request->input('page', 1); // Halaman default adalah 1
        $limit = 10; // Jumlah hasil per halaman
        $offset = ($page - 1) * $limit; // Hitung offset berdasarkan halaman yang dipilih

        // Client untuk menghubungi endpoint SPARQL
        $sparql = new Client('http://localhost:3030/movies/sparql');
        $query = "
        PREFIX film: <http://example.org/movie#>
        SELECT DISTINCT ?id ?name ?datePublished ?rating ?voters ?description ?thumbnail ?genre
        WHERE {
            ?movie a film:Movie;
                film:id ?id;
                film:name ?name;
                film:datePublished ?datePublished;
                film:rating ?rating;
                film:voters ?voters;
                film:description ?description;
                film:image ?thumbnail;
                film:genre ?genre.

            FILTER (
                REGEX(?name, \"$keywords\", 'i') ||
                REGEX(?description, \"$keywords\", 'i') ||
                REGEX(?genre, \"$keywords\", 'i') ||
                REGEX(?datePublished, \"$keywords\", 'i')
            )
        }
        ORDER BY ?name
        LIMIT $limit OFFSET $offset
        ";

        try {
            // Eksekusi query SPARQL
            $sparqlResult = $sparql->query($query);
            $results = [];

            // Pastikan hasil query tidak kosong
            if (!empty($sparqlResult)) {
                foreach ($sparqlResult as $row) {
                    $id = $row->id->getValue();
                    $name = $row->name->getValue();
                    $datePublished = $row->datePublished->getValue();

                    // Cek apakah thumbnail adalah objek EasyRdf\Resource
                    if ($row->thumbnail instanceof \EasyRdf\Resource) {
                        $thumbnail = $row->thumbnail->getUri();
                    } else {
                        $thumbnail = isset($row->thumbnail) ? $row->thumbnail->getValue() : 'N/A';
                    }

                    // Menghindari duplikasi berdasarkan ID
                    if (!isset($results[$id])) {
                        $results[$id] = [
                            'id' => $id,
                            'name' => $name,
                            'thumbnail' => $thumbnail,
                            'datePublished' => $datePublished,
                        ];
                    }
                }
            } else {
                return back()->with('error', 'No results found for your search.');
            }

            // Query untuk menghitung total hasil pencarian
            $totalResultsQuery = "
            PREFIX film: <http://example.org/movie#>
            SELECT (COUNT(DISTINCT ?id) AS ?total)
            WHERE {
                ?movie a film:Movie;
                    film:id ?id;
                    film:name ?name;
                    film:datePublished ?datePublished;
                    film:rating ?rating;
                    film:voters ?voters;
                    film:description ?description;
                    film:image ?thumbnail;
                    film:genre ?genre.

                FILTER (
                    REGEX(?name, \"$keywords\", 'i') ||
                    REGEX(?description, \"$keywords\", 'i') ||
                    REGEX(?genre, \"$keywords\", 'i') ||
                    REGEX(?datePublished, \"$keywords\", 'i')
                )
            }
        ";

            // Eksekusi query untuk menghitung total hasil pencarian
            $totalResults = $sparql->query($totalResultsQuery);
            $total = $totalResults[0]->total->getValue(); // Ambil total hasil

            // Hitung jumlah total halaman
            $totalPages = ceil($total / $limit);

            return view('result', [
                'results' => $results,
                'currentPage' => $page,
                'totalPages' => $totalPages,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while processing your search.');
        }
    }
}
