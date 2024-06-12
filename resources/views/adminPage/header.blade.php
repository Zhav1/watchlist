<header>
    <div class="flex flex-row justify-between bg-[#0D0E11] gap-4 p-7 px-10">
        <div class="flex flex-row gap-2">
            <div class="size-10">
                <img src={{ asset('img/image_2024-05-11_110207674-removebg-preview.png') }}>
            </div>
            <div class="brand-name font-bold text-xl py-2 text-white">MovieStack</div>
        </div>
        <div class="flex flex-row justify-evenly gap-x-10 place-items-center">
            <button>
                <a href="{{ route('admin') }}">Home</a>
            </button>
            <button>
                <a href="{{ route('detailmovie') }}">Movies</a>
            </button>
            <button>
                <a href="{{ route('detailuser') }}">Users</a>
            </button>
            <button>
                <a href="{{ route('input') }}">Input User</a>
            </button>
        </div>
        <div class="flex flex-row gap-2">
            <div class="dropdown dropdown-bottom dropdown-end">
                <div tabindex="0" role="button" class="btn m-1 border-[#393939] border-2 border-solid rounded-xl px-10 py-1.5 text-base">{{auth()->user()->name}}</div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 text-black font-bold">
                    <li>
                        <button>
                            <a href="{{ route('detailmovie') }}">Movies</a>
                        </button>
                    </li>
                    <li>
                        <button>
                            <a href="{{ route('detailuser') }}">Users</a>
                        </button>
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            </div>
        </div>   
    </div>
</header
