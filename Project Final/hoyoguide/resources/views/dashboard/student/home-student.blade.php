@extends('dashboard.template')

@section('header')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold">Top Course</h1>

    <form action="{{ route('courses.search') }}" method="GET" class="flex items-center">
        <input type="text" name="query" placeholder="Search courses" class="p-2 border border-gray-300">
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Search
        </button>
    </form>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($courses as $item)
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('images/icon.png') }}" alt="{{ $item->course_name }}"
            class="w-full h-32 object-cover object-center">
        <div class="p-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $item->course_name }}</h3>
            <p class="text-gray-600 dark:text-gray-400">
                {{ \Illuminate\Support\Str::limit($item->deskripsi, 50, $end='...') }}
            </p>
            <div class="mt-4">
                <p class="text-gray-700 dark:text-gray-300">Tanggal Mulai: {{ $item->tanggal_mulai }}</p>
                <p class="text-gray-700 dark:text-gray-300">Tanggal Selesai: {{ $item->tanggal_selesai }}</p>
                <p class="text-gray-700 dark:text-gray-300">Pengajar: {{ $item->teacher_name }}</p>
            </div>
            <div
                class="bg-gray-100 dark:bg-gray-700 px-4 py-2 border-t border-gray-200 dark:border-gray-600 flex justify-end items-end">
                @if(now() <= $item->tanggal_selesai)
                    <button type="submit" class="text-blue-500 hover:underline">Join Course</button>
                    @else
                    <span class="text-gray-500">Registration Closed</span>
                    @endif
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection