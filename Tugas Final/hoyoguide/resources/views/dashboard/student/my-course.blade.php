@extends('dashboard.template')

@section('header')
Course yang Diikuti
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
                <p class="text-gray-700 dark:text-gray-300">Jumlah Peserta: {{ $item->jumlah_peserta }}</p>

                @if(now() <= $item->tanggal_selesai)
                    <a href="{{ route('student.contents.index', ['courseId' => $item->id]) }}"
                        class="text-blue-500 hover:underline">Lihat Konten</a>
                @else
                    <span class="text-gray-500">Tidak dapat melihat konten</span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
