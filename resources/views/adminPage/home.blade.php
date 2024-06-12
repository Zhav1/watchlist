@extends('adminPage.layout')

@section('admin')
    <section class="bg-white rounded-xl w-full relative h-max p-6 flex flex-col gap-10">
        <div class="stats shadow border-4">
            <div class="stat place-items-center">
                <div class="stat-title">MOVIES</div>
                <div class="stat-value">{{ $totalMovies }}</div>
                <div class="stat-desc">TOTAL</div>
            </div>
            <div class="stat place-items-center">
                <div class="stat-title">USERS</div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-desc">TOTAL</div>
            </div>
            <div class="stat place-items-center">
                <div class="stat-title">COMMENTS</div>
                <div class="stat-value">{{ $totalComments }}</div>
                <div class="stat-desc">TOTAL</div>
            </div>
        </div>

        <h2 class="text-2xl text-gray-700">Movie List</h2>
        <div class="overflow-x-auto">
            <table class="table bg-neutral">
                <!-- head -->
                <thead class="text-white">
                    <tr>
                        <th>No</th>
                        <th>Movie Name</th>
                        <th>Total Users</th>
                        <th>Total Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->users_count }}</td> <!-- Jumlah user yang memiliki movie ini -->
                            <td>{{ $item->comments_count }}</td> <!-- Jumlah komentar untuk movie ini -->
                        </tr>
                    @endforeach
                </tbody>
                <h4 class="text-1xl text-blue-500"><a href="{{ route('detailmovie') }}">Detail Movies-></a></h3>
            </table>
            {{-- Menambahkan pagination links --}}
            {{ $comments->links() }}
        </div>

        <h2 class="text-2xl text-gray-700">User List</h2>
        <div class="overflow-x-auto">
            <table class="table bg-neutral">
                <!-- head -->
                <thead class="text-white">
                    <tr>
                        <th>No</th>
                        <th>User Name</th>
                        <th>Total Movies in Watchlist</th>
                        <th>Total Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->watchlists_count }}</td>
                            <td>{{ $user->comments_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <h4 class="text-1xl text-blue-500"><a href="{{ route('detailuser') }}">Detail Users-></a></h3>
            </table>
            {{-- Menambahkan pagination links --}}
            {{ $users->links() }}
        </div>
    </section>
@endsection
