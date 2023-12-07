@extends('dashboard.template')

@section('header')
Daftar Content {{ $course->course_name }}
@endsection

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ url("/admin/courses") }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4
                focus:outline-none dark:focus:ring-blue-800 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg
                text-sm px-5 py-2.5 text-center mb-2">
        Kembali ke Course
    </a>
    <a href="{{ route('admin.contents.create', ['courseId' => $course->id]) }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none dark:focus:ring-green-800 font-medium rounded-lg
    text-sm px-5 py-2.5 text-center mb-2 ml-auto">
        Tambah Content
    </a>

</div>

@if ($contents)
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    @foreach($contents as $content)
    <div class="bg-white dark:bg-gray-800 shadow-md p-4 rounded-lg mb-4 mt-4">
        <h4 class="text-xl font-bold mb-2">{{ $content->judul }}</h4>
        <p class="text-md">{{ Str::limit($content->materi, 50) }}</p>
        <a href="{{ route('admin.contents.edit', ['content' => $content->id]) }}"
            class="text-blue-500 hover:underline mt-2 block">Edit Konten</a>
    </div>
    @endforeach
</div>
@else
<p class="text-gray-500">Belum ada isi materi untuk course ini.</p>
@endif
@endsection