@extends('dashboard.template')

@section('header')
Tambah Konten
@endsection

@section('content')
<form method="POST" action="{{ route('teacher.contents.store', ['courseId' => $course->id]) }}">
    @csrf

    <input type="hidden" id="course_id" name="course_id" value="{{ $course->id }}">

    <div class="mb-6">
        <label for="judul" class="block mb-2 text-sm font-medium dark:text-white">Judul</label>
        <input type="text" id="judul" name="judul"
            class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-800 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            placeholder="Judul Konten" required>
    </div>

    <div class="mb-6">
        <label for="materi" class="block mb-2 text-sm font-medium dark:text-white">Materi</label>
        <textarea id="materi" name="materi"
            class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-800 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            placeholder="Isi Materi" required></textarea>
    </div>

    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Tambah Content
    </button>

    <a href="{{ url()->previous() }}"
        class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-500">
        Batal
    </a>
</form>
@endsection