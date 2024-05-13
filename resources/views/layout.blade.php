<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Watch-List</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/script.js"></script>
  @vite('resources/css/app.css')
</head>

<body class="bg-[#0D0E11]">
  <section class="flex flex-col gap-8">
    <section class="flex flex-col gap-20 text-white">
      @include('header')
      @include('hero')
    </section>
      
    @yield('main')
  </section>
</body>