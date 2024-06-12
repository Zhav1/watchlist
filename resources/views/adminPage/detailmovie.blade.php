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
                <table class="table table-xs bg-neutral">
                  <thead class="text-white">
                    <tr>
                      <th></th>
                      <th>Movie Name</th>
                      <th>Genre</th>
                      <th>Year</th>
                      <th>Run-Time</th>
                      <th>Director</th>
                      <th>Writer</th>
                      <th>Country</th>
                      <th>Language</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>1</th>
                      <td>Cy Ganderton</td>
                      <td>Quality Control Specialist</td>
                      <td>Littel, Schaden and Vandervort</td>
                      <td>Canada</td>
                      <td>12/16/2020</td>
                      <td>Blue</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
        </section>
    </section>
</body>
