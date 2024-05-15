<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie['Title'] }}</title>
</head>
<body>
    <h1>{{ $movie['Title'] }}</h1>
    <p>Year: {{ $movie['Year'] }}</p>
    <p>Genre: {{ $movie['Genre'] }}</p>
    <p>Director: {{ $movie['Director'] }}</p>
    <p>Plot: {{ $movie['Plot'] }}</p>
    <img src="{{ $movie['Poster'] }}" alt="{{ $movie['Title'] }} Poster">

    <a href="/">Search Another Movie</a>
</body>
</html>