<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Watch-List</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/script.js"></script>
  @vite('resources/css/app.css')
</head>
<body class="h-full bg-[#0D0E11] text-white">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="{{ asset('img/image_2024-05-11_110207674-removebg-preview.png') }}" alt="Your Company">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-white">Registrate your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/register" method="POST">
        @csrf
        {{-- Form Username --}}
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-white">Username</label>
            <div class="mt-2">
              <input id="name" name="name" type="text" autocomplete="name" value="{{old('name')}}" required class="@error('name')
                is-invalid
              @enderror w-full rounded-md border-0 px-2 py-3 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        {{-- End Form Username --}}
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        {{-- Form Email --}}
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-white">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" value="{{old('email')}}" required class="@error('email')
            is-invalid
          @enderror block w-full rounded-md border-0 py-1.5 px-3 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- End Form Email --}}
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        {{-- Form password --}}
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-white">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="@error('password')
            is-invalid
          @enderror block w-full rounded-md border-0 py-1.5 px-2 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- End Form password --}}
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-[#CFF245] hover:bg-[#AAC73C] px-3 py-1.5 text-sm font-semibold leading-6 text-black shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registration</button>
        </div>
      </form>
      <p class="mt-10 text-center text-sm text-gray-500">
        Already Register?
        <a href="/login" class="font-semibold leading-6 text-[#CFF245] hover:text-[#AAC73C]">Login here! | </a>
        <a href="/" class="font-semibold leading-6 text-[#CFF245] hover:text-[#AAC73C]">Return T_T</a>
      </p>
    </div>
  </div>

