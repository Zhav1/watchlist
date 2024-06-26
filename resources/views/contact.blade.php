<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us!</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}"></script> --}}
    @vite('resources/css/app.css')
</head>
<body class="w-screen h-screen">
    <section class="w-screen flex flex-col bg-[#0D0E11]">
        <section class="bg-[#0D0E11] w-screen flex flex-col gap-16">
            <section class="flex flex-col px-5 gap-12 text-white">
                @include('main.header')
                <div class="flex flex-col gap-8">
                    <div class="text-7xl text-center">
                        <h1>Contact us!</h1>
                    </div>
                </div>
            </section>
            <section class="bg-white rounded-xl w-full relative h-max p-6 flex flex-col gap-10">
                <div class="flex flex-col gap-8 w-3/4 place-self-center">
                   <p class="text-center text-2xl">We'd love to hear from you! Whether you have a question about our service, feedback on how we can improve, or if you just want to say hello, please don't hesitate to reach out. You can use the form below to contact us directly!
                   </p>
                    <form action="{{ route('contactStore') }}" method="POST" class="flex flex-col gap-8">
                    @csrf
                        <div class="flex flex-col">
                            <div class="label">
                                <span class="label-text">Your name?</span>
                                <span class="label-text-alt"></span>
                            </div>
                            <input type="text" placeholder="Name" class="input input-bordered border-2 w-full text-black" name="contact_name"/>
                        </div>
                        <div class="flex flex-col">
                            <div class="label">
                                <span class="label-text">Your Email?</span>
                                <span class="label-text-alt"></span>
                            </div>
                            <input type="text" placeholder="Email" class="input input-bordered border-2 w-full text-black" name="contact_email"/>
                        </div>
                        <div class="flex flex-col">
                            <label class="form-control">
                                <div class="label">
                                    <span class="label-text">Care to give some opinion? Whether it is only a question, feedbacks, or critics, please don't hesitate :D</span>
                                </div>
                            <textarea class="textarea textarea-bordered border-2 rounded-xl h-54" name="contact_text"></textarea>
                            </label>
                        </div>
                        <button class="btn btn-wide bg-[#CFF245] hover:bg-[#AAC73C]" type="submit">Submit</button>
                    </form>
                </div>
            </section>
        </section>
        @include('main.footer')
    </section>
</body>
</html>
