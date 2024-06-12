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
    <section class="flex flex-col gap-8">
        <section class="flex flex-col gap-20 text-white">
            @include('adminPage.header')
        </section>
        <section class="bg-white rounded-xl w-full relative h-max p-6 flex flex-col gap-10">
            <div class="overflow-x-auto">
                <table class="table bg-neutral">
                  <thead>
                    <tr class="text-white">
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $item )
                    <tr>
                      <th>{{$item->id}}</th>
                      <td>{{$item->name}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->created_at}}</td>
                      <td>{{$item->updated_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </section>
        @include('main.footer')
    </section>
</body>
