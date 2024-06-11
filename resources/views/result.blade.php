<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search results for {{ $search }}</title>
    <link rel="stylesheet" href={{ asset('css/result.css') }}>
    <script src={{ asset('js/script.js') }}></script>
    @vite('resources/css/app.css')
</head>
<body class="w-screen h-screen">
    <section class="w-screen flex flex-col bg-[#0D0E11]">
        <section class="bg-[#0D0E11] w-screen flex flex-col gap-16">
            <section class="flex flex-col px-5 gap-12 text-white">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-row gap-2 py-5">
                        <div class="size-10"><img src={{ asset('img/image_2024-05-11_110207674-removebg-preview.png') }}></div>
                        <div class="brand-name font-bold text-xl py-2 text-white">MovieStack</div>
                    </div>
                    <div class="flex flex-row justify-evenly gap-x-8 py-9">
                        <div><a href="/">Home</a></div>
                        <div><a href="/watchlists">My Watchlist</a></div>
                        <div>Contact</div>
                    </div>
                    <div class="py-7">
                        <div class="flex flex-row gap-2">
                            @auth
                                <div class="dropdown">
                                    <div tabindex="0" role="button"
                                        class="btn m-1 border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5">
                                        {{ auth()->user()->name }}</div>
                                    <ul tabindex="0"
                                        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                        <li><a href="#"
                                                class="btn border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5 text-black">Dashboard</a>
                                        </li>
                                        {{-- <li><a href="{{route('user')}}" class="btn border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5 text-black">User</a></li> --}}
                                        <li>
                                            <form action="/logout" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="btn border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5 text-black">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="border-[#393939] border-2 border-solid rounded-2xl px-6 py-1.5">
                                    <a href="/login">Log in</a>
                                </div>
                                <div class="border-[#393939] border-2 border-solid rounded-2xl px-6 py-1.5">
                                    <a href="/register">Register</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <div class="text-5xl text-center">
                        <h1>Movies related to : {{ $search }}</h1>
                    </div>
                </div>
            </section>
            <section class="bg-white rounded-xl w-full relative h-max p-6 flex flex-col gap-20 py-24">
                <div class="grid gap-16 justify-between grid-cols-2 reveal w-11/12 place-self-center">
                    @if (@isset($movies))
                        @forelse ($movies as $movie)
                        <div class="card card-side bg-base-100 shadow-xl place-self-center h-96 w-full">
                            <figure class="w-1/2"><img src="{{ $movie['Poster'] }}" alt="{{ $movie['Title'] }}" class="h-96"/></figure>
                            <div class="card-body w-1/2">
                                <h2 class="card-title">{{ $movie['Title'] }}</h2>
                                <p>{{ $movie['Year'] }}</p>
                                <div class="card-actions justify-end">
                                <form action="{{ route('movies.create') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">
                                    <button class=" btn bg-[#CFF245] hover:bg-[#AAC73C]" type="submit">Add</button>
                                </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        
                        @endforelse
                    @endif
                </div>
                <div class="inline-block self-center w-3/6 content-center flex flex-col">
                    
                    <form action="{{ route('movies.search') }}" method="get">
                    @csrf
                        <label class="form-control w-full flex flex-row">
                            <div class="label">
                                <span class="label-text"></span>
                                <span class="label-text-alt"></span>
                            </div>
                            @if ($errors->any())
                                <input type="text" placeholder="Movie that you've just inputted is doesn't exist T_T" class="input input-bordered input-error w-full border-4 text-black" name="movie_name"/>
                            @else
                                <input type="text" placeholder="Enter a movie that you wanna watch later?" class="input input-bordered w-full text-black" name="movie_name"/>
                            @endif
                            <div class="label">
                                <span class="label-text-alt"></span>
                                <span class="label-text-alt"></span>
                            </div>
                            @auth
                            <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]" type="submit">Submit</button>
                            @else
                            <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]"><a href="{{ route('login') }}">Submit</a></button>
                            @endauth
                        </label>
                    </form>
                </div>
            </section>
        </section>
        @include('main.footer')
    </section>
</body>
</html>

