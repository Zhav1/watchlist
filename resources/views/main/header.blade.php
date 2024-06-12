<header class="px-5">
    <div class="flex flex-row justify-between bg-[#0D0E11]">
        <div class="flex flex-row gap-2 p-5 px-10">
            <div class="size-10"><img src={{ asset('img/image_2024-05-11_110207674-removebg-preview.png') }}></div>
            <div class="brand-name font-bold text-xl py-2 text-white">MovieStack</div>
        </div>
        <div class="flex flex-row justify-evenly gap-x-10 place-items-center text-xs">
            <div><a href="/">Home</a></div>
            <div><a href="/watchlists">My Watchlist</a></div>
            @auth
            @if (auth()->user()->role == 'admin')
            <div><a href="{{ route('input') }}">Input User</a></div>
            @endif
            @endauth
            <button>
                <a href="{{ route('contactIndex') }}">
                    <div>Contact Us!</div>
                </a>
            </button>
        </div>
        <div class="py-7">
            <div class="flex flex-row gap-2">
                @auth
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn m-1 border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5">{{auth()->user()->name}}</div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5 text-black">Logout</button>
                        </form>
                    </li>
                    </ul>
                </div>
                @else
                <div class="border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5">
                    <a href="/login">Log in</a>
                </div>
                <div class="border-[#393939] border-2 border-solid rounded-2xl px-10 py-1.5">
                    <a href="/register">Register</a>
                </div>
                @endauth
            </div>
        </div>
     </div>
</header
