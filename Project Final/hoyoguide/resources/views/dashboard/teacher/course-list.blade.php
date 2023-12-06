@extends('dashboard.template')

@section('header')
Daftar Course
@endsection

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    @if ($courses)
    @foreach ($courses as $item)
    <div class="dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('images/icon.png') }}" alt="{{ $item->course_name }}"
            class="w-full h-32 object-cover object-center">
        <div class="p-4">
            <h3 class="text-xl font-semibold dark:text-white">{{ $item->course_name }}</h3>
            <p class="dark:text-gray-400">
                {{ \Illuminate\Support\Str::limit($item->deskripsi, 50, $end='...') }}
            </p>
            <div class="mt-4">
                <p class="dark:text-gray-300">Tanggal Mulai: {{ $item->tanggal_mulai }}</p>
                <p class="dark:text-gray-300">Tanggal Selesai: {{ $item->tanggal_selesai }}</p>
                <p class="dark:text-gray-300">Pengajar: {{ $item->teacher_name }}</p>
            </div>
            <div class="px-4 py-2 flex justify-end items-end">
                <a href="{{ url('teacher/courses/' . $item->id . '/edit') }}"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none dark:focus:ring-blue-800 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-3 py-2 text-center mt-2">
                    Kelola Course</a>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <p>Tidak ada course yang tersedia.</p>
    @endif
</div>
@endsection