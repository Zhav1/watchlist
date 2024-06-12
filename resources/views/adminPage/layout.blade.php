<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>MovieStack</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/script.js"></script>
  @vite('resources/css/app.css')
</head>

<body class="bg-[#0D0E11] overflow-x-auto flex flex-col">
  <section class="flex flex-col">    
    <section class="flex flex-col text-white">
      @include('adminPage.header')
      <div class="flex flex-col gap-8 py-24">
          <div class="text-7xl text-center">
              <h1>Admin Page</h1>
          </div>
      </div>
    @yield('admin')
    </section>
    @include('main.footer')
  </section>
</body>