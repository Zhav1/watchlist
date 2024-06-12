@extends('main.layout')

@section('main')
<section class="bg-white rounded-xl relative w-full self-center reveal">
    <div class="flex flex-col py-20 gap-12">
        <div class="badge bg-[#CFF245] place-self-center p-3">Watchlist</div>
        <div class="w-3/4 place-self-center">
            <h1 class="text-4xl text-center">Create your personalized movie watchlist to track and organize films you want to see, ensuring you never miss out on your favorites!</h1>
        </div>
        <div class="w-3/4 place-self-center flex flex-col gap-20">
            <div class="mockup-window border bg-base-300">
                <div class="flex justify-center bg-base-200">
                    <img src="{{ asset('img/Screenshot 2024-06-11 201052.png') }}" alt="" class="h-full">
                </div>
            </div>
            <div class="flex flex-row gap-8 justify-between">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">
                        Wathclist Management
                            <div class="badge badge-secondary">NEW</div>
                        </h2>
                        <p>Easily manage and organize your watchlist.</p>
                        <div class="card-actions justify-end">
                        <div class="badge badge-outline">Fashion</div> 
                        <div class="badge badge-outline">Products</div>
                        </div>
                    </div>
                    <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                </div>
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">
                        Detailed Movie Info
                            <div class="badge badge-secondary">NEW</div>
                        </h2>
                        <p>Access comprehensive details about each movie.</p>
                        <div class="card-actions justify-end">
                        <div class="badge badge-outline">Fashion</div> 
                        <div class="badge badge-outline">Products</div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="text-4xl text-center place-self-center">Choose your pricing plan!</h1>
            <div class="card w-96 bg-[#0D0E11] shadow-xl place-self-center">
                <div class="card-body flex-col flex gap-8">
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-row gap-4">
                            <h2 class="card-title line-through text-white">$34.99</h2>
                            <div class="badge bg-[#CFF245] mt-1">Free</div>
                        </div>
                        <p class="text-xs text-[#868788]">Per user, per month, for now.</p>
                    </div>
                    <div class="flex flex-col gap-4 text-white">
                        <p>Personalized movie recommendations</p>
                        <p>Unlimited watchlist management</p>
                        <p>Access to trending movies</p>
                        <p>Detailed movie information</p>
                        <p>Community reviews and ratings</p>
                    </div >
                    <div class="card-actions justify-end">
                    <button class="btn bg-[#CFF245]">Get Started</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- @foreach ($films as $film)
        <div class="card card-compact w-1/2 bg-base-100 shadow-xl self-center reveal px-4">
            <a href="{{ route('showMovies', ['id' => $film->id]) }}">
                <figure><img src="{{ $film->poster }}" alt="{{ $film->title }}" /></figure>
            </a>
            <div class="card-body justify-between">
                <h2 class="card-title">{{ $film->title }}</h2>
                <p class="text-sm">{{ $film->plot }}</p>
                <div class="flex flex-row justify-between">
                    <div class="flex content-center">
                        <p class="text-sm text-center text-gray-600">Added by: {{ auth()->user()->name }}</p>
                    </div>
                    <div class="card-actions justify-end gap-12">
                        <button class="btn bg-[#CFF245] hover:bg-[#AAC73C] text-black font-bold py-2 px-4 rounded-xl">
                            <a href="{{ route('showMovies', ['id' => $film->id]) }}">View</a>
                        </button>
                        <a href="{{ route('editMovie', ['id' => $film->id]) }}" class="btn btn-warning">Edit</a>
                        @auth
                        <form action="{{ route('deleteMovie', ['id' => $film->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-error" type="submit">Delete</button>
                        </form>
                        @else
                        <button class="btn btn-error">Delete</button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach --}}
    </div>
</section>
@endsection
