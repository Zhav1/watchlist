<header class="h-[70px] fixed top-0 left-0 right-0 z-50 bg-[rgba(0,0,0,0.75)] backdrop-blur-md shadow-lg">
    <div class="flex flex-row justify-between gap-4 px-10 h-full items-center">
        <div class="flex flex-row gap-2 h-full items-center">
            <div class="size-10">
                <img src="{{ asset('img/image_2024-05-11_110207674-removebg-preview.png') }}" alt="MovieStack Logo"
                    class="h-10">
            </div>
            <div class="brand-name font-bold text-xl text-white">MovieStack</div>
        </div>
        <div class="flex flex-row justify-evenly gap-x-10">
            <button class="text-white hover:text-[#CFF245] transition duration-300">
                <a href="{{ route('dashboard') }}">Home</a>
            </button>
            <button class="text-white hover:text-[#CFF245] transition duration-300">
                <a href="{{ route('movies.index') }}">My Watchlist</a>
            </button>
            <div class="dropdown">
                <div tabindex="0" role="button">
                    <i class="fa-solid fa-magnifying-glass hover:text-[#CFF245] text-white"></i>
                </div>
                <div tabindex="0"
                    class="dropdown-content menu bg-[rgba(0,0,0,0.75)] backdrop-blur-md shadow-lg rounded-box z-[1] w-screen p-2 mt-6 shadow place-self-center -left-20 right-0 -translate-x-3 -translate-y-0.5">
                    <div class="inline-block self-center w-3/6 content-center">
                        <form action="{{ route('movies.search') }}" method="get">
                            <label class="form-control w-full flex flex-row">
                                <div class="label">
                                    <span class="label-text"></span>
                                    <span class="label-text-alt"></span>
                                </div>
                                @if ($errors->any())
                                    <input type="text"
                                        placeholder="Keywords don't exist."
                                        class="input input-bordered input-error w-full border-4 text-black"
                                        name="keywords" />
                                @else
                                    <input type="text" placeholder="Enter Keywords"
                                        class="input input-bordered w-full text-black" name="keywords" />
                                @endif
                                <div class="label">
                                    <span class="label-text-alt"></span>
                                    <span class="label-text-alt"></span>
                                </div>
                                {{-- @auth --}}
                                    <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]" type="submit">Submit</button>
                                {{-- @else
                                    <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]"><a
                                            href="{{ route('login') }}">Submit</a></button>
                                @endauth --}}
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row gap-2">
            @auth
                <div class="dropdown dropdown-bottom dropdown-end">
                    <div tabindex="0" role="button"
                        class="btn m-1 border-[#393939] border-2 border-solid rounded-xl px-10 py-1.5 text-base text-white hover:bg-[#CFF245] transition duration-300">
                        {{ auth()->user()->name }}</div>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 text-black font-bold">
                        <li>
                            <button>
                                <a href="{{ route('movies.index') }}">My Watchlist</a>
                            </button>
                        </li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5">
                    <a href="/login" class="text-white hover:text-[#CFF245] transition duration-300">Log in</a>
                </div>
                <div class="border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5">
                    <a href="/register" class="text-white hover:text-[#CFF245] transition duration-300">Register</a>
                </div>
            @endauth
        </div>
    </div>
</header>
