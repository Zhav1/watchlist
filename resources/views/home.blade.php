@extends('layout')

@section('main')
    <section class="bg-white rounded-xl relative w-full self-center reveal">
        <div class="flex flex-col py-20 gap-12">
            <div class="badge bg-[#CFF245] place-self-center">Watchlist</div>
            <div class="w-3/4 place-self-center">
                <h1 class="text-4xl text-center">Create your personalized movie watchlist to track and organize films you want to see, ensuring you never miss out on your favorites!</h1>
            </div>
            <div class="card card-compact w-1/2 bg-base-100 shadow-xl self-center reveal">
                <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Shoes!</h2>
                    <p class="text-sm">If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions justify-end gap-8">
                        <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]">View</button>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-error">Delete</button>
                    </div>
                </div>
            </div>
            <div class="card card-compact w-1/2 bg-base-100 shadow-xl self-center reveal">
                <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Shoes!</h2>
                    <p class="text-sm">If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions justify-end gap-8">
                        <button class="btn bg-[#CFF245] hover:bg-[#AAC73C]">View</button>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-error">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection