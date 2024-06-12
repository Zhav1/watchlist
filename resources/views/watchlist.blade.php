<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ auth()->user()->name }}'s Watchlist!</title>
    <link rel="stylesheet" href={{ asset('css/styles.css') }}>
    <script src={{ asset('js/script.js') }}></script>
    @vite('resources/css/app.css')
</head>

<body class="w-screen h-screen">
    <section class="w-screen flex flex-col bg-[#0D0E11]">
        <section class="bg-[#0D0E11] w-screen flex flex-col gap-16">
            <section class="flex flex-col px-5 gap-12 text-white">
                @include('main.header')
                <div class="flex flex-col gap-8">
                    <div class="text-7xl text-center">
                        <h1>{{ auth()->user()->name }}'s Watchlist!</h1>
                    </div>
                </div>
            </section>
            <section class="bg-white rounded-xl relative w-full self-center reveal flex flex-col">
                <div class="flex flex-col py-20 gap-20">
                    {{-- Sorting Form --}}
                    <form action="{{ url('/watchlists') }}" method="GET" class="">
                        <div class="flex place-content-center gap-80 flex-row">
                            <div class="flex flex-col gap-4">
                                <label for="sort_genre" class="mr-2 text-lg text-gray-700">Sort by Genre:</label>
                                <select name="sort_genre" id="sort_genre" class="select select-success w-48 mt-1 bg-white border border-[#CFF245] border-3 rounded-md shadow-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" onchange="this.form.submit()">
                                    <option value="">All Genres</option>
                                    @foreach(['Action', 'Comedy', 'Drama', 'Horror', 'Romance', 'Sci-Fi', 'Adventure', 'Animation', 'Biography', 'Crime', 'Documentary', 'Family', 'Fantasy', 'History', 'Music', 'Musical', 'Mystery', 'Sport', 'Superhero', 'Thriller', 'War', 'Western'] as $genre)
                                        <option value="{{ $genre }}" {{ request('sort_genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-4">
                                <label for="sort_country" class="mr-2 text-lg text-gray-700">Sort by Country:</label>
                                <select name="sort_country" id="sort_country" class="select select-success w-48 mt-1 bg-white border border-[#CFF245] border-3 rounded-md shadow-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" onchange="this.form.submit()">
                                    <option value="">All Countries</option>
                                    @foreach(['United States','Indonesia', 'UK', 'Canada', 'France', 'Germany', 'India', 'Japan', 'China', 'Australia', 'Spain'] as $country)
                                        <option value="{{ $country }}" {{ request('sort_country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-4">
                                <label for="sort_language" class="mr-2 text-lg text-gray-700">Sort by Language:</label>
                                <select name="sort_language" id="sort_language" class="select select-success w-48 mt-1 bg-white border border-[#CFF245] border-3 rounded-md shadow-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" onchange="this.form.submit()">
                                    <option value="">All Languages</option>
                                    @foreach(['English','Indonesia', 'Spanish', 'French', 'German', 'Hindi', 'Japanese', 'Mandarin', 'Korean'] as $language)
                                        <option value="{{ $language }}" {{ request('sort_language') == $language ? 'selected' : '' }}>{{ $language }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="grid gap-16 justify-between grid-cols-3 grid-flow-row-dense w-11/12 place-self-center col-start-2 row-start-2">
                        @forelse ($movies as $film)
                        <div class="card w-96 bg-base-100 shadow-xl">
                        <figure><img src="{{ $film->poster }}" alt="Shoes" /></figure>
                            <div class="card-body flex-col flex gap-6">
                                <h2 class="card-title">{{ $film->title }}</h2>
                                <p>{{ $film->plot }}</p>
                                <div class="card-actions justify-end font-bold flex flex-row gap-">
                                    <a href="{{ route('showMovies', ['id' => $film->id]) }}" class="btn bg-[#CFF245] hover:bg-[#AAC73C] rounded-xl">View</a>
                                    <a href="{{ route('editMovie', ['id' => $film->id]) }}" class="btn btn-warning rounded-xl">Edit</a>
                                    <form action="{{ route('watchlist.remove', ['id' => $film->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-error rounded-xl" type="submit">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>    
                        @empty
                        <div class="text-3xl text-center place-self-center col-span-3">
                            <h1>Your watchlist is currently empty. Start adding items to see them here! </h1>
                        </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </section>
        @include('main.footer')
    </section>

    <script>
        // Toggle the dropdown menu
        document.querySelector('.dropdown > button').addEventListener('click', function() {
            document.querySelector('.dropdown-menu').classList.toggle('hidden');
        });

        // Hide the dropdown menu when clicking outside
        window.addEventListener('click', function(e) {
            if (!document.querySelector('.dropdown').contains(e.target)) {
                document.querySelector('.dropdown-menu').classList.add('hidden');
            }
        });
    </script>
</body>

</html>
