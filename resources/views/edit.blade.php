<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $film->title }}</title>
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
                    <div class="badge bg-[#CFF245] self-center p-3">My Watchlist</div>
                    <div class="text-7xl text-center">
                        <h1>{{ $film->title }}</h1>
                    </div>
                </div>
            </section>
            <section class="bg-white rounded-xl w-full relative h-max p-6 flex flex-col gap-10">
                <div class="flex flex-row gap-4">
                    <div class="flex w-full">
                        <div class="flex card rounded-box w-2/5 p-20 object-center">
                            <img class="" src="{{ $film->poster }}" alt="Poster">
                        </div>
                        <div class="divider divider-horizontal"></div>
                        <div class="flex card rounded-box w-3/5 place-self-center gap-8 grow">
                             <form action="{{ route('updateMovie', $film->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $film->id }}">
                                <div class="flex flex-col gap-4">
                                    <div>
                                        <label for="title" class="block">Title</label>
                                        <input type="text" name="title" id="title" value="{{ $film->title }}"
                                            class="input input-bordered w-full" required>
                                    </div>
                                    <div>
                                        <label for="language" class="block">Language</label>
                                        <input type="text" name="language" id="language" value="{{ $film->language }}"
                                            class="input input-bordered w-full" required>
                                    </div>
                                    <div>
                                        <label for="year" class="block">Year</label>
                                        <input type="text" name="year" id="year" value="{{ $film->year }}"
                                            class="input input-bordered w-full" required>
                                    </div>
                                    <div>
                                        <label for="runtime" class="block">Runtime</label>
                                        <input type="text" name="runtime" id="runtime" value="{{ $film->runtime }}"
                                            class="input input-bordered w-full" required>
                                    </div>
                                    <div>
                                        <label for="director" class="block">Director</label>
                                        <input type="text" name="director" id="director" value="{{ $film->director }}"
                                            class="input input-bordered w-full" required>
                                    </div>
                                    <div>
                                        <label for="writer" class="block">Writer</label>
                                        <input type="text" name="writer" id="writer" value="{{ $film->writer }}"
                                            class="input input-bordered w-full" required>
                                    </div>
                                    <div>
                                        <label for="country" class="block">Country</label>
                                        <input type="text" name="country" id="country" value="{{ $film->country }}"
                                            class="input input-bordered w-full" required>
                                    </div>
                                    <div>
                                        <label for="genre" class="block">Genre</label>
                                        <input type="text" name="genre" id="genre" value="{{ $film->genre }}"
                                            class="input input-bordered w-full" required>
                                    </div>
                                    <div>
                                        <label for="plot" class="block">Plot</label>
                                        <textarea name="plot" id="plot" class="textarea textarea-bordered w-full"
                                            required>{{ $film->plot }}</textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="btn bg-[#CFF245] hover:bg-[#AAC73C]">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>               
            </section>
        </section>
        @include('main.footer')
    </section>


</body>
