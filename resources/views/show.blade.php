<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $film->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3">
                <img src="{{ $film->poster }}" class="w-full rounded-lg shadow-md" alt="{{ $film->title }} poster">
            </div>
            <div class="md:w-2/3 md:ml-8">
                <h1 class="text-4xl font-bold mb-4">{{ $film->title }}</h1>
                <p class="text-gray-700 mb-2"><strong>Plot:</strong> {{ $film->plot }}</p>
                <p class="text-gray-700 mb-2"><strong>Genre:</strong> {{ $film->genre }}</p>
                <p class="text-gray-700 mb-2"><strong>Year:</strong> {{ $film->year }}</p>
                <p class="text-gray-700 mb-2"><strong>Runtime:</strong> {{ $film->runtime }}</p>
                <p class="text-gray-700 mb-2"><strong>Director:</strong> {{ $film->director }}</p>
                <p class="text-gray-700 mb-2"><strong>Writer:</strong> {{ $film->writer }}</p>
                <p class="text-gray-700 mb-2"><strong>Country:</strong> {{ $film->country }}</p>
                <p class="text-gray-700 mb-2"><strong>Language:</strong> {{ $film->language }}</p>
            </div>
        </div>

        <!-- Form for Adding Comments -->
        <div class="mt-10">
            <form action="{{ route('addComment') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <input type="hidden" name="movie_id" value="{{ $film->id }}">
                <div class="form-control w-full">
                    <div class="flex relative">
                        <input name="comment" type="text" placeholder="Add Comment"
                               class="input input-bordered w-full pr-16" autocomplete="off" />
                        @auth
                        <button type="submit" class="btn btn-success absolute right-0 top-0 h-full">Send</button>
                        @else
                        <button class="btn btn-success absolute right-0 top-0 h-full"><a href="/login">Send</a></button>
                        @endauth
                    </div>
                    @error('comment')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </div>

        <!-- Display Comments -->
        <div class="mt-10 space-y-6">
            @forelse($film->comments as $comment)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex flex-col items-start">
                        <div class="bg-green-100 p-4 rounded-lg">
                            <p class="text-lg text-gray-700">{{ $comment->comment }}</p>
                        </div>
                        <div class="flex justify-between items-center mt-4 w-full">
                            <p class="text-gray-500 text-sm">{{ $comment->tanggal }}</p>
                            @auth
                            <form action="/deleteComment/{{ $comment->comment_id }}" method="POST" class="opacity-50">
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
    </div>
</body>
</html>
