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
<body class="h-full">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Created User</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="{{route('admin')}}" method="POST">
        @csrf
        {{-- Form Username --}}
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
            <div class="mt-2">
              <input id="name" name="name" type="text" autocomplete="name" value="{{old('name')}}" required class="@error('name')
                is-invalid
              @enderror w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" value="{{old('email')}}" required class="@error('email')
            is-invalid
          @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="@error('password')
            is-invalid
          @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- End Form password --}}
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div>
            <div class="flex items-center justify-between">
                <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Role</label>
            </div>
            <div class="mt-2">
            <select class="select select-bordered w-full max-w-xs block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"" id="role" name="role" required>
                <option disabled selected>Choose your role!</option>
                <option>admin</option>
                <option>user</option>
            </select>
            </div>
        </div>
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
      </form>
      <p class="mt-10 text-center text-sm text-gray-500">
        <a href="/" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Return Here!</a>
      </p>
    </div>
  </div>

