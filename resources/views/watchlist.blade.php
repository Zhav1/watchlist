<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-[#0D0E11] w-full py-5">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center text-white px-5">
            <div class="flex items-center gap-2">
                <img src="{{ asset('img/image_2024-05-11_110207674-removebg-preview.png') }}" alt="Logo" class="h-10">
                <span class="brand-name font-bold text-xl">MovieStack</span>
            </div>
            <nav class="flex gap-8 mt-4 md:mt-0">
                <a href="/" class="hover:text-gray-300">Home</a>
                <a href="/watchlists" class="hover:text-gray-300">My Watchlist</a>
                <a href="{{ route('contactIndex') }}" class="hover:text-gray-300">Contact Us!</a>
            </nav>
            <div class="flex items-center gap-4 mt-4 md:mt-0">
                @auth
                <div class="relative">
                    <button class="flex items-center bg-transparent border-2 border-gray-500 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu absolute right-0 mt-2 w-48 bg-white text-black rounded-md shadow-lg hidden">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">Dashboard</a></li>
                        <li>
                            <form action="/logout" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-200">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a href="/login" class="border-2 border-gray-500 rounded-full px-4 py-2 hover:bg-gray-800">Log in</a>
                <a href="/register" class="border-2 border-gray-500 rounded-full px-4 py-2 hover:bg-gray-800">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Movie List</h1>

        {{-- Sorting Form --}}
        <form action="{{ url('/watchlists') }}" method="GET" class="mb-8">
            <div class="flex flex-wrap justify-center gap-4">
                <div>
                    <label for="sort_genre" class="mr-2 text-lg text-gray-700">Sort by Genre:</label>
                    <select name="sort_genre" id="sort_genre" class="form-select block w-48 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" onchange="this.form.submit()">
                        <option value="">All Genres</option>
                        @foreach(['Action', 'Comedy', 'Drama', 'Horror', 'Romance', 'Sci-Fi', 'Adventure', 'Animation', 'Biography', 'Crime', 'Documentary', 'Family', 'Fantasy', 'History', 'Music', 'Musical', 'Mystery', 'Sport', 'Superhero', 'Thriller', 'War', 'Western'] as $genre)
                            <option value="{{ $genre }}" {{ request('sort_genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="sort_country" class="mr-2 text-lg text-gray-700">Sort by Country:</label>
                    <select name="sort_country" id="sort_country" class="form-select block w-48 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" onchange="this.form.submit()">
                        <option value="">All Countries</option>
                        @foreach(['United States','Indonesia', 'UK', 'Canada', 'France', 'Germany', 'India', 'Japan', 'China', 'Australia', 'Spain'] as $country)
                            <option value="{{ $country }}" {{ request('sort_country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="sort_language" class="mr-2 text-lg text-gray-700">Sort by Language:</label>
                    <select name="sort_language" id="sort_language" class="form-select block w-48 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" onchange="this.form.submit()">
                        <option value="">All Languages</option>
                        @foreach(['English','Indonesia', 'Spanish', 'French', 'German', 'Hindi', 'Japanese', 'Mandarin', 'Korean'] as $language)
                            <option value="{{ $language }}" {{ request('sort_language') == $language ? 'selected' : '' }}>{{ $language }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        {{-- Movies List --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($movies as $film)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <a href="{{ route('showMovies', ['id' => $film->id]) }}">
                    <figure><img src="{{ $film->poster }}" alt="{{ $film->title }}" class="w-full h-64 object-cover" /></figure>
                </a>
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $film->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $film->plot }}</p>
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500">Added by: {{ auth()->user()->name }}</p>
                        <div class="flex space-x-2 text-right mt-3">
                            <a href="{{ route('showMovies', ['id' => $film->id]) }}" class="px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">View</a>
                            <a href="{{ route('editMovie', ['id' => $film->id]) }}" class="px-4 py-2 bg-yellow-500 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">Edit</a>
                            @auth
                            <form action="{{ route('deleteMovie', ['id' => $film->id]) }}" method="post" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">Delete</button>
                            </form>
                            @else
                            <button class="px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-lg shadow-md cursor-not-allowed" disabled>Delete</button>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

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
