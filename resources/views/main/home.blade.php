    <section class="bg-[#0D0E11] rounded-xl relative w-full self-center flex flex-col px-20 gap-10">
        <div class="flex flex-col pt-20 gap-8">
            <div class="place-self-start flex flex-col gap-2 grow w-full">
                <div class="text-[#CFF245] text-[28px]">Top Rated Movies</div>
                <h1 class="text-base text-[#9E9FA0]">The best-reviewed films, according to critics and audiences alike.
                </h1>
            </div>
            <div class="carousel carousel-center bg-transparent rounded-box max-w-full space-x-4">
                @foreach ($topRatedMovies as $content)
                   <div class="carousel-item scale-95">
                    <a href="{{ route('showMovies', ['id'=> $content['id']]) }}" class="flex flex-col gap-4 items-center">
                        <img src="{{ $content['image'] }}" class="rounded-lg h-[410px] w-[270px] object-cover transition-transform duration-300 hover:scale-105" />
                        <div class="pl-1 text-lg text-white max-w-64 text-center hover:text-[#CFF245] transition duration-300">{{ $content['name'] }}</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-8">
            <div class="place-self-start flex flex-col gap-2 grow w-full">
                <div class="text-[#CFF245] text-[28px]">Action Packed</div>
                <h1 class="text-base text-[#9E9FA0]">Get your adrenaline rushing with the most thrilling action films.
                </h1>
            </div>
            <div class="carousel carousel-center bg-transparent rounded-box max-w-full space-x-4">
                @foreach ($actionMovies as $content)
                    <div class="carousel-item scale-95">
                    <a href="{{ route('showMovies', ['id'=> $content['id']]) }}" class="flex flex-col gap-4 items-center">
                        <img src="{{ $content['image'] }}" class="rounded-lg h-[410px] w-[270px] object-cover transition-transform duration-300 hover:scale-105" />
                        <div class="pl-1 text-lg text-white max-w-64 text-center hover:text-[#CFF245] transition duration-300 mt-2">{{ $content['name'] }}</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-8">
            <div class="place-self-start flex flex-col gap-2 grow w-full">
                <div class="text-[#CFF245] text-[28px]">Romantic Tales</div>
                <h1 class="text-base text-[#9E9FA0]">Feel the love with movies that capture the beauty, passion, and
                    heartbreak of romance</h1>
            </div>
            <div class="carousel carousel-center bg-transparent rounded-box max-w-full space-x-4">
                 @foreach ($romanceMovies as $content)
                    <div class="carousel-item scale-95">
                    <a href="{{ route('showMovies', ['id'=> $content['id']]) }}" class="flex flex-col gap-4 items-center">
                        <img src="{{ $content['image'] }}" class="rounded-lg h-[410px] w-[270px] object-cover transition-transform duration-300 hover:scale-105" />
                        <div class="pl-1 text-lg text-white max-w-64 text-center hover:text-[#CFF245] transition duration-300 mt-2">{{ $content['name'] }}</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-8">
            <div class="place-self-start flex flex-col gap-2 grow w-full">
                <div class="text-[#CFF245] text-[28px]">Dramatic Masterpieces</div>
                <h1 class="text-base text-[#9E9FA0]">Dive into powerful stories and emotional performances that leave a lasting impact.</h1>
            </div>
            <div class="carousel carousel-center bg-transparent rounded-box max-w-full space-x-4">
                 @foreach ($dramaMovies as $content)
                    <div class="carousel-item scale-95">
                    <a href="{{ route('showMovies', ['id'=> $content['id']]) }}" class="flex flex-col gap-4 items-center">
                        <img src="{{ $content['image'] }}" class="rounded-lg h-[410px] w-[270px] object-cover transition-transform duration-300 hover:scale-105" />
                        <div class="pl-1 text-lg text-white max-w-64 text-center hover:text-[#CFF245] transition duration-300 mt-2">{{ $content['name'] }}</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-8">
            <div class="place-self-start flex flex-col gap-2 grow w-full">
                <div class="text-[#CFF245] text-[28px]">Recommended for You</div>
                <h1 class="text-base text-[#9E9FA0]">Personalized picks tailored to your taste—discover movies you'll
                    love.</h1>
            </div>
            <div class="carousel carousel-center bg-transparent rounded-box max-w-full space-x-4">
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
                <div class="carousel-item flex flex-col gap-2">
                    <img src="https://m.media-amazon.com/images/M/MV5BYTkzMjc0YzgtY2E0Yi00NDBlLWI0MWUtODY1ZjExMDAyOWZiXkEyXkFqcGc@._V1_SX300.jpg"
                        class="rounded-box" />
                    <div class="pl-1 text-lg text-white">Shoes</div>
                </div>
            </div>
        </div>
    </section>



    {{-- <div class="flex flex-row gap-8 justify-between w-full place-self-center max-h-[350px]">
                <div class="card scale-75 bg-transparent shadow-xl">
                    <figure>
                        <img src="https://m.media-amazon.com/images/M/MV5BMzUzNDM2NzM2MV5BMl5BanBnXkFtZTgwNTM3NTg4OTE@._V1_SX300.jpg" alt="Shoes" />     
                    </figure>
                    <div class="card-body flex-col flex gap-2">
                        <h2 class="card-title text-white">Shoes</h2>
                    </div>
                </div>
                <div class="card scale-75 bg-transparent shadow-xl">
                    <figure>
                        <img src="https://m.media-amazon.com/images/M/MV5BMzUzNDM2NzM2MV5BMl5BanBnXkFtZTgwNTM3NTg4OTE@._V1_SX300.jpg" alt="Shoes" />     
                    </figure>
                    <div class="card-body flex-col flex gap-2">
                        <h2 class="card-title text-white">Shoes</h2>
                    </div>
                </div>
                <div class="card scale-75 bg-transparent shadow-xl">
                    <figure>
                        <img src="https://m.media-amazon.com/images/M/MV5BMzUzNDM2NzM2MV5BMl5BanBnXkFtZTgwNTM3NTg4OTE@._V1_SX300.jpg" alt="Shoes" />     
                    </figure>
                    <div class="card-body flex-col flex gap-2">
                        <h2 class="card-title text-white">Shoes</h2>
                    </div>
                </div>
                <div class="card scale-75 bg-transparent shadow-xl">
                    <figure>
                        <img src="https://m.media-amazon.com/images/M/MV5BMzUzNDM2NzM2MV5BMl5BanBnXkFtZTgwNTM3NTg4OTE@._V1_SX300.jpg" alt="Shoes" />     
                    </figure>
                    <div class="card-body flex-col flex gap-6">
                        <h2 class="card-title text-white">Shoes</h2>
                    </div>
                </div>
            </div>
            </div> --}}
