@extends('layout')

@section('main')
    <section class="bg-white rounded-xl relative w-full self-center reveal">
        <div class="flex flex-col py-20 gap-12">
            <div class="badge bg-[#CFF245] place-self-center">Watchlist</div>
            <div class="w-3/4 place-self-center">
                <h1 class="text-4xl text-center">Create your personalized movie watchlist to track and organize films you want to see, ensuring you never miss out on your favorites!</h1>
            </div>
                @foreach ($films as $film)
                    <div class="card card-compact w-1/2 bg-base-100 shadow-xl self-center reveal">
                        <figure><img src="{{ $film->poster }}" alt="{{ $film->title }}" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ $film->title }}</h2>
                            <p class="text-sm">{{ $film->plot }}</p>
                            <div class="card-actions justify-end gap-8">
                                <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]">View</button>
                                <button class="btn btn-warning">Edit</button>
                                @auth
                                    <form action="/delete/{{ $film->id }}" method="post">
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
                @endforeach
        </div>
    </section>
@endsection
