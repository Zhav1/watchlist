<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $personDetails['nama'] ?? 'Person Not Found' }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
    @vite('resources/css/app.css')
</head>

<body class="w-screen h-screen">
    @include('main.header')
    <section class="w-screen flex flex-col bg-[#0D0E11]">
        <section class="bg-[#0D0E11] w-screen flex flex-col">
            <section class="rounded-xl w-full relative h-max p-6 flex flex-col gap-2 place-content-center text-white">
                <div class="flex flex-row gap-4">
                    <div class="flex w-full">
                        <div class="flex card rounded-box w-2/5 p-20 object-center">
                            <img class="" src="{{ $personDetails['image'] ?? asset('images/placeholder.png') }}"
                                alt="Poster">
                        </div>
                        <div class="divider divider-horizontal"></div>
                        <div class="flex card rounded-box w-3/5 place-self-center gap-8 grow">
                            <div class="flex-row flex gap-12 max-w-fit">
                                <div class="stats stats-vertical flex flex-col bg-transparent">
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Nama</div>
                                        <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                            {{ $personDetails['nama'] ?? 'Unknown' }}
                                        </div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Tempat Lahir</div>
                                        <div class="stat-value text-xl text-[#9E9FA0]">
                                            {{ $personDetails['tempatlahir'] ?? 'Unknown' }}
                                        </div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Tanggal Lahir</div>
                                        <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                            {{ $personDetails['tanggallahir'] ?? 'Unknown' }}
                                        </div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Tanggal Wafat</div>
                                        <div class="stat-value text-xl text-[#9E9FA0] text-pretty">
                                            {{ $personDetails['tanggalwafat'] ?? 'Unknown' }}
                                        </div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Pekerjaan</div>
                                        <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                            {{ $personDetails['pekerjaan'] ?? 'Unknown' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="stats stats-vertical flex flex-col bg-transparent">
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Country</div>
                                        <div class="stat-value text-xl text-pretty text-[#9E9FA0]">
                                            {{ $personDetails['country'] ?? 'Unknown' }}
                                        </div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title text-white">Awards</div>
                                        <div class="stat-value text-xl text-[#9E9FA0] text-pretty">
                                            {{ $personDetails['award'] ?? 'None' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stats stats-vertical max-w-fit bg-transparent">
                    <div class="stat gap-2">
                        <div class="stat-title text-white">Description</div>
                        <div class="text-lg text-pretty text-[#9E9FA0]">
                            {{ $personDetails['description'] ?? 'No description available' }}
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
