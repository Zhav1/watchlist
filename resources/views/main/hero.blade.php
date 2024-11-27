<section class="flex flex-col h-screen justify-center items-center relative">
    <video loop autoplay muted class="absolute top-0 left-0 w-full h-full object-cover z-0 grayscale opacity-75">
        <source src="{{ asset('img/video.mp4') }}" type="video/mp4">
    </video>
    <div class="flex flex-col gap-6 z-10 flex-wrap content-center justify-center max-w-5xl px-10 text-center">
        <h1 class="text-8xl text-white">Your Personalized Movie Playlist Awaits!</h1>
        <p class="text-2xl font-extralight text-[#E0E0E0]">MovieStack is your go-to destination for managing and curating your personal movie watchlist.</p>
        <div class="inline-block content-center">
            <form action="{{ route('movies.search') }}" method="get">
                @auth
                <button class="btn bg-[#CFF245] hover:bg-[#AAC73C] text-black font-bold py-2 px-4 rounded transition duration-300" type="submit">Submit</button>
                @else
                <button class="btn bg-[#CFF245] hover:bg-[#AAC73C] text-black font-bold py-2 px-4 rounded transition duration-300 place-self-center">
                    <a href="{{ route('login') }}">Submit</a>
                </button>
                @endauth
            </form>
        </div>
    </div>
</section>