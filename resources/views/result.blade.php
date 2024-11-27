<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search results for {{ request('keywords') }}</title>
    <link rel="stylesheet" href={{ asset('css/result.css') }}>
    <script src={{ asset('js/script.js') }}></script>
    @vite('resources/css/app.css')
</head>

<body class="w-screen bg-[#0D0E11] flex flex-col gap-40">
    @include('main.header')

    <section class="bg-[#0D0E11] w-screen flex flex-col gap-16 pt-40">
        <div class="text-5xl text-center">
            <h1 class="text-[#868788]">
                Movies related to:
                <span class="text-white">"{{ request('keywords') }}"</span>
            </h1>
        </div>

        <section class="bg-white rounded-xl w-full relative h-max p-6 flex flex-col gap-20 py-24">
            <div class="grid gap-16 justify-between grid-cols-2 reveal w-11/12 place-self-center">
                @if (isset($results) && count($results) > 0)
                    @foreach ($results as $movie)
                        {{-- <div class="carousel-item scale-95 flex flex-col items-center">
                            <a href="{{ route('showMovies', ['id' => $movie['id']]) }}" class="block">
                                <img src="{{ $movie['thumbnail'] }}" alt="{{ $movie['name'] }}"
                                    class="rounded-lg shadow-lg w-60 h-80 object-cover">
                                <h2 class="mt-2 text-lg text-white text-center">{{ $movie['name'] }}</h2>
                            </a>
                        </div> --}}
                        <div class="card bg-base-100 shadow-xl place-self-center w-full">
                            <a href="{{ route('showMovies', ['id' => $movie['id']]) }}" class="block">
                                <figure class=""><img src="{{ $movie['thumbnail'] }}" alt="{{ $movie['name'] }}"
                                        class="" /></figure>
                                <div class="card-body">
                                    <h2 class="card-title">{{ $movie['name'] }}</h2>
                                    <p>{{ $movie['datePublished'] }}</p>
                                </div>
                                <div class="card-actions justify-end">
                                    <div class="badge badge-outline">Fashion</div>
                                    <div class="badge badge-outline">Products</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-gray-400">
                        <p>No movies found for "{{ request('keywords') }}".</p>
                    </div>
                @endif
            </div>
            @if ($totalPages > 1)
                <div class="join">
                    <!-- Previous Button -->
                    @if ($currentPage > 1)
                        <a href="{{ route('movies.search', ['keywords' => request('keywords'), 'page' => $currentPage - 1]) }}"
                            class="join-item btn btn-square hover:bg-[#CFF245] border-0 bg-transparent"
                            aria-label="Previous">
                            «
                        </a>
                    @endif

                    <!-- Page Buttons -->
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <a href="{{ route('movies.search', ['keywords' => request('keywords'), 'page' => $i]) }}"
                            class="join-item btn btn-square hover:bg-[#CFF245] border-0 bg-transparent
                  {{ $i == $currentPage ? 'btn btn-active' : '' }}"
                            aria-label="Page {{ $i }}">
                            {{ $i }}
                        </a>
                    @endfor

                    <!-- Next Button -->
                    @if ($currentPage < $totalPages)
                        <a href="{{ route('movies.search', ['keywords' => request('keywords'), 'page' => $currentPage + 1]) }}"
                            class="join-item btn btn-square hover:bg-[#CFF245] border-0 bg-transparent"
                            aria-label="Next">
                            »
                        </a>
                    @endif
                </div>

            @endif

        </section>
    </section>

    @include('main.footer')
</body>

</html>
