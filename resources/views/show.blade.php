<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $movie ? $movie['name'] : 'Movie Not Found' }}</title>
    <link rel="stylesheet" href={{ asset('css/styles.css') }}>
    <script src={{ asset('js/script.js') }}></script>
    @vite('resources/css/app.css')
</head>

<body class="w-screen h-screen">
    @include('main.header')
    <section class="w-screen flex flex-col bg-[#0D0E11]">
        <section class="bg-[#0D0E11] w-screen flex flex-col">
            <div class="relative w-full aspect-video overflow-hidden rounded-lg">
                @if (!empty($movie['trailer']))
                    <iframe class="w-full h-full" src="{{ $movie['trailer'] }}" title="Sample Movie" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @else
                    <video loop autoplay muted class="w-full h-full">
                        <source src="{{ asset('img/video.mp4') }}" type="video/mp4">
                    </video>
                @endif
                <div
                    class="absolute inset-x-0 bottom-0 h-2/4 bg-gradient-to-t from-[#0D0E11] to-transparent flex items-center">
                    <p class="text-white font-bold text-5xl absolute bottom-4 left-6">{{ $movie['name'] }}</p>
                </div>
            </div>
            <section class="rounded-xl w-full relative h-max p-6 flex flex-col gap-2 place-content-center text-white">
                <div class="flex flex-row gap-4">
                    <div class="flex w-full">
                        <div class="flex card rounded-box w-2/5 p-20 object-center">
                            <img class="" src="{{ $movie['image'] }}" alt="Poster">
                        </div>
                        <div class="divider divider-horizontal"></div>
                        <div class="flex card rounded-box w-3/5 place-self-center gap-8 grow">
                            <div class="flex-row flex gap-12 max-w-fit">
                                <div class="stats stats-vertical flex flex-col bg-transparent">
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Year</div>
                                        <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                            {{ $movie['datePublished'] }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Languages</div>
                                        <div class="stat-value text-xl text-[#9E9FA0]">
                                            {{ $movie['language'] }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Runtime</div>
                                        <div class="stat-value text-xl text-[#9E9FA0] text-pretty">
                                            {{ $movie['duration'] }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Genre</div>
                                        <div class="stat-value text-xl text-[#9E9FA0] text-pretty">
                                            {{ implode(', ', $movie['genres']) }}</div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Rating</div>
                                        <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                            {{ $movie['rating'] }}</div>
                                        <div class="stat-desc text-white">{{ $movie['voters'] }}</div>
                                    </div>
                                </div>
                                <div class="stats stats-vertical flex flex-col bg-transparent">
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Director</div>
                                        <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                            @if (!empty($movie['directors']))
                                                @foreach ($movie['directors'] as $director)
                                                    @if (!empty($director['uri']))
                                                        <a href="{{ route('showperson', ['id' => $director['uri']]) }}"
                                                            target="_blank"
                                                            class="text-[#CFF245]">{{ $director['name'] }}</a>
                                                    @else
                                                        {{ $director }}
                                                    @endif
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            @else
                                                No directors found.
                                            @endif
                                            <div class="stat-desc"></div>
                                        </div>
                                        <div class="stat gap-2">
                                            <div class="stat-title text-white">Writer</div>
                                            <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                                @if (!empty($movie['writers']))
                                                    @foreach ($movie['writers'] as $writer)
                                                        @if (!empty($writer['uri']))
                                                            <a href="{{ route('showperson', ['id' => $writer['uri']]) }}"
                                                                target="_blank"
                                                                class="text-[#CFF245]">{{ $writer['name'] }}</a>
                                                        @else
                                                            {{ $writer }}
                                                        @endif
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                @else
                                                    No writers found.
                                                @endif
                                                <div class="stat-desc"></div>
                                            </div>
                                            <div class="stat gap-2">
                                                <div class="stat-title text-white">Country</div>
                                                <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                                    {{ $movie['country'] }} </div>
                                                <div class="stat-desc"></div>
                                            </div>
                                            <div class="stat gap-2">
                                                <div class="stat-title text-white">Awards</div>
                                                <div class="stat-value text-xl text-[#9E9FA0] text-pretty">
                                                    {{ $movie['award'] }}
                                                </div>
                                            </div>
                                            <div class="stat gap-2">
                                                <div class="stat-title text-white">Actor</div>
                                                <div class="stat-value text-xl text-[#9E9FA0] text-pretty">
                                                    @if (!empty($movie['actors']))
                                                        @foreach ($movie['actors'] as $actor)
                                                            @if (!empty($actor['uri']))
                                                                <a href="{{ route('showperson', ['id' => $actor['uri']]) }}"
                                                                    target="_blank"
                                                                    class="text-[#CFF245]">{{ $actor['name'] }}</a>
                                                            @else
                                                                {{ $actor }}
                                                            @endif
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        No actors found.
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="stats stats-vertical max-w-fit bg-transparent">
                            <div class="stat gap-2">
                                <div class="stat-title text-white">Plot</div>
                                <div class="text-lg text-pretty text-[#9E9FA0]">{{ $movie['description'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                <div class="flex flex-col pt-10 gap-8">
                    <div class="place-self-start flex flex-col gap-2 grow w-full">
                        <div class="text-[#CFF245] text-[28px]">Movies Like This</div>
                        <h1 class="text-base text-[#9E9FA0]">Find films similar to what you're looking right now.
                        </h1>
                    </div>
                    <div class="carousel carousel-center bg-transparent rounded-box max-w-full space-x-4">
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                        <div class="carousel-item flex flex-col gap-2">
                            <img src="https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_SX300.jpg"
                                class="rounded-box" />
                            <div class="pl-1 text-lg text-white">Shoes</div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        @include('main.footer')
    </section>


</body>
