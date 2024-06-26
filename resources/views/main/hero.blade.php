<section class="flex flex-col">
    <div class="flex flex-col gap-6 z-10">
        <div class="badge bg-[#CFF245] self-center p-3">Free</div>
        <h1 class="text-5xl text-center">Your Personalize Movie Playlist Awaits!</h1>
        <p class="text-xl text-center font-extralight w-1/2 place-self-center text-[#9E9FA0]">MovieStack is your go-to destination for managing and curating your personal movie watchlist.</p>
        <div class="inline-block self-center w-3/6 content-center">
            <form action="{{ route('movies.search') }}" method="get">
            @csrf
                <label class="form-control w-full flex flex-row">
                    <div class="label">
                        <span class="label-text"></span>
                        <span class="label-text-alt"></span>
                    </div>
                    @if ($errors->any())
                        <input type="text" placeholder="Movie that you've just inputted is doesn't exist T_T" class="input input-bordered input-error w-full border-4 text-black" name="movie_name"/>
                    @else
                        <input type="text" placeholder="Enter a movie that you wanna watch later?" class="input input-bordered w-full text-black" name="movie_name"/>
                    @endif
                    <div class="label">
                        <span class="label-text-alt"></span>
                        <span class="label-text-alt"></span>
                    </div>
                    @auth
                    <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]" type="submit">Submit</button>
                    @else
                    <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]"><a href="{{ route('login') }}">Submit</a></button>
                    @endauth
                </label>
            </form>
        </div>
    </div>
    <div class="w-full justify-center flex">
        <div class="rotate-180 -scale-x-100 max-w-6xl absolute top-[350px]">
            <img src="img/cylinder.png" alt="">
        </div>
        <img src="img/hero.jpeg" alt="" class="max-h-max self-center">
    </div>
</section>
