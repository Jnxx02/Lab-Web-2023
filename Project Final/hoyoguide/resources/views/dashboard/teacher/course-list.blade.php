@extends('dashboard.template')

@section('header')
Daftar Course
@endsection

@section('content')
<div class="mb-8">
    @include('dashboard.teacher.create-course')
</div>

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
                <p class="text-gray-700 dark:text-gray-300">Jumlah Peserta: {{ $item->participant_count }}</p>
            </div>
            <div
                class="bg-gray-100 dark:bg-gray-700 px-4 py-2 border-t border-gray-200 dark:border-gray-600 flex justify-end items-end">
                <a href="{{ url('/course/' . $item->id . '/edit') }}" class="text-blue-500 hover:underline">Kelola Course</a>
            </div>

        </div>
    </div>
    @endforeach
</div>


@endsection