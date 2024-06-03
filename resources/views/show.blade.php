<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $film->title }}</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/script.js"></script>
  @vite('resources/css/app.css')
</head>
<body class="w-screen h-screen">
    <section class="w-screen flex flex-col bg-[#0D0E11]">
        <section class="bg-[#0D0E11] w-screen flex flex-col gap-16">
            <section class="flex flex-col px-5 gap-12 text-white">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-row gap-2 py-5">
                        <div class="size-10"><img src="img/image_2024-05-11_110207674-removebg-preview.png"></div>
                        <div class="brand-name font-bold text-xl py-2 text-white">MovieStack</div>
                    </div>
                    <div class="flex flex-row justify-evenly gap-x-8 py-9">
                        <div><a href="/">Home</a></div>
                        <div>My Watchlist</div>
                        <div>Contact</div>
                    </div>
                    <div class="py-7">
                        <div class="flex flex-row gap-2">
                            @auth
                            <div class="dropdown">
                                <div tabindex="0" role="button" class="btn m-1 border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5">{{auth()->user()->name}}</div>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                <li><a href="#" class="btn border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5 text-black">Dashboard</a></li>
                                {{-- <li><a href="{{route('user')}}" class="btn border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5 text-black">User</a></li> --}}
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="btn border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5 text-black">Logout</button>
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
                    <div class="badge bg-[#CFF245] self-center">My Watchlist</div>
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
                                        <div class="stat-value text-2xl">{{ $film->country }}</div>
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
                                    <div class="stat-value text-lg text-pretty ">{{ $film->plot }}</div>
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
                                <input name="comment" type="text" placeholder="Add Comment" class="input input-bordered w-full join-item" autocomplete="off" />
                                @auth
                                <button type="submit" class="btn bg-[#CFF245] hover:bg-[#AAC73C] join-item">Send</button>
                                @else
                                <button class="btn bg-[#CFF245] hover:bg-[#AAC73C] join-item"><a href="/login">Send</a></button>
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
                    @forelse($film->comments as $comment)
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex flex-col items-start">
                                <div class="chat chat-start">
                                    <div class="chat-bubble bg-[#CFF245] text-black text-pretty break-words">{{ $comment->comment }}</div>
                                    <div class="">Added by: {{$comment->user_id->name}}</div>
                                </div>
                                <div class="flex justify-between items-center mt-4 w-full">
                                    <p class="text-gray-500 text-sm">{{ $comment->tanggal }}</p>
                                    @auth
                                    <form action="/deleteComment/{{ $comment->comment_id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-error btn-sm" type="submit">Delete</button>
                                    </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No comments yet.</p>
                    @endforelse
                </div>
            </section>
        </section>
        @include('main.footer')
    </section>


</body>
