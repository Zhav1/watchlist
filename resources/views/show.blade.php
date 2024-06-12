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
                    <div class="badge bg-[#CFF245] self-center p-3">My Movie</div>
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
                            <div class="flex-row flex gap-12 max-w-fit">
                                <div class="stats stats-vertical flex flex-col">
                                    <div class="stat gap-2">
                                        <div class="stat-title">Language</div>
                                        <div class="stat-value text-2xl text-pretty">{{ $film->language }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title">Year</div>
                                        <div class="stat-value text-2xl">{{ $film->year }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title">Runtime</div>
                                        <div class="stat-value text-2xl">{{ $film->runtime }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                </div>
                                <div class="stats stats-vertical flex flex-col">
                                    <div class="stat gap-2">
                                        <div class="stat-title">Director</div>
                                        <div class="stat-value text-2xl text-pretty">{{ $film->director }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title">Writer</div>
                                        <div class="stat-value text-2xl text-pretty">{{ $film->writer }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                    <div class="stat gap-2">
                                        <div class="stat-title">Country</div>
                                        <div class="stat-value text-2xl text-pretty">{{ $film->country }}</div>
                                        <div class="stat-desc"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="stats stats-vertical max-w-fit place-items-center">
                                <div class="stat gap-2">
                                    <div class="stat-title">Genre</div>
                                    <div class="stat-value text-2xl">{{ $film->genre }}</div>
                                </div>
                            </div>
                            <div class="stats stats-vertical max-w-fit">
                                <div class="stat gap-2">
                                    <div class="stat-title">Plot</div>
                                    <div class="text-lg text-pretty ">{{ $film->plot }}</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- Form for Adding Comments -->
                <div class="w-3/6 self-center">
                    <form action="{{ route('addComment') }}" method="POST" class="bg-white p-6 rounded-lg">
                        @csrf
                        <input type="hidden" name="movie_id" value="{{ $film->id }}">
                        <div class="form-control w-full">
                            <div class="label">
                                <span class="label-text">What's on your mind?</span>
                            </div>
                            <div class="flex relative join">
                                <input name="comment" type="text" placeholder="Add Comment"
                                    class="input input-bordered w-full join-item" autocomplete="off" />
                                @auth
                                    <button type="submit"
                                        class="btn bg-[#CFF245] hover:bg-[#AAC73C] join-item">Send</button>
                                @else
                                    <button class="btn bg-[#CFF245] hover:bg-[#AAC73C] join-item"><a
                                            href="/login">Send</a></button>
                                @endauth
                            </div>
                            @error('comment')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>

                <!-- Display Comments and footer-->
                <div class="w-4/6 space-y-6 self-center">
                    @if ($film->comments)
                        @foreach ($film->comments as $comment)
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <div class="flex flex-col items-start">
                                    <div class="">{{ $comment->user->name }}</div>
                                    <div class="chat chat-start p-4">
                                        <div class="bg-[#CFF245] text-black text-pretty break-words p-2 py-3 rounded-xl w-fit">
                                            {{ $comment->comment }}</div>
                                        </div>
                                    <div class="flex justify-between items-center mt-4 w-full">
                                        <p class="text-gray-500 text-sm">{{ $comment->tanggal }}</p>
                                        @auth
                                        <form action="{{ route('deleteComment', ['id' => $comment->comment_id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-error btn-sm" type="submit">Delete</button>
                                        </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">No comments yet.</p>
                    @endif
                </div>
                <a href="{{ route('movies.index') }}" class="place-self-center">
                    <button class="btn btn-warning w-48">Back?</button>
                </a>
            </section>
        </section>
        @include('main.footer')
    </section>


</body>
