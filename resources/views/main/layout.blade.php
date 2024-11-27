<!DOCTYPE html>
<html lang="en" class="h-full bg-white w-screen">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>MovieStack</title>
  <link rel="stylesheet" href={{ asset('css/styles.css') }}>
  <script src={{ asset('js/script.js') }}></script>
  @vite('resources/css/app.css')
</head>

<body class="bg-[#0D0E11] overflow-x-auto flex flex-col w-screen">
  <section class="flex flex-col">
    <section class="flex flex-col text-white">
      @include('main.header')
      @include('main.hero')
    </section>
    @include('main.home')
    @include('main.footer')
  </section>
</body>
