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
<body class="h-full bg-[#0D0E11] text-white">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="{{ asset('img/image_2024-05-11_110207674-removebg-preview.png') }}" alt="Your Company">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-white">Sign in to your account</h2>
      @if (session()->has('loginError'))
        <div role="alert" class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{session('loginError')}}</span>
          </div>
        @endif
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/login" method="POST">
        @csrf
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-white">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" value="{{old('email')}}" autofocus required class="@error('email')
            is-invalid
          @enderror block w-full rounded-md border-0 py-1.5 px-3 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-white ">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="@error('password')
            is-invalid
          @enderror block w-full rounded-md border-0 px-3 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-[#CFF245] hover:bg-[#AAC73C] px-3 py-1.5 text-sm font-semibold leading-6 text-black shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
        </div>
      </form>
      <p class="mt-10 text-center text-sm text-gray-500">
        Not Registered Yet?
        <a href="/register" class="font-semibold leading-6 text-[#CFF245] hover:text-[#AAC73C]">Register!</a>
        <a href="/" class="font-semibold leading-6 text-[#CFF245] hover:text-[#AAC73C]">Return T_T</a>
      </p>
    </div>
  </div>

