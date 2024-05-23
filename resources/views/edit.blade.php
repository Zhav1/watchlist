<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-3xl font-bold">Edit Movie</h1>

        <form action="{{ route('updateMovie') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md mt-4">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $film->id }}">

            <div class="mb-4">
                <label for="movie_name" class="block text-gray-700 font-bold mb-2">Update Movie Title:</label>
                <input type="text" name="movie_name" id="movie_name" value="{{ $film->title }}" 
                       class="input input-bordered w-full">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Update Movie</button>
            </div>
        </form>
    </div>
</body>
</html>
