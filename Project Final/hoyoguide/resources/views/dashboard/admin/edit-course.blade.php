@extends('dashboard.template')

@section('header')
Kelola Course
@endsection

@section('content')
<form method="POST" action="{{ url("/admin/courses/{$selectedCourse->id}") }}" class="mb-6 flex justify-between
    items-center">
    @csrf
    @method('DELETE')
    <a href="/admin/courses"
        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none dark:focus:ring-blue-800 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
        Kembali </a>
    <h3 class="mb-2 text-3xl font-bold tracking-tight dark:text-white">
        Data Course
    </h3>
    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
        class="block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
        type="button">
        Hapus
    </button>

    <div id="popup-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full backdrop-blur-sm backdrop-brightness-75">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal dark:text-gray-400">
                        Apakah kamu yakin ingin menghapus course ini?
                    </h3>
                    <button data-modal-hide="popup-modal" type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Hapus
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="{{ url("/admin/courses/{$selectedCourse->id}") }}">
    @csrf
    @method('PUT')
    <div class="mb-6 flex justify-between items-center gap-3">
        <div class="w-10/12">
            <label for="course_name" class="block mb-2 text-sm font-medium dark:text-white">Nama Course</label>
            <input type="text" id="course_name" name="course_name"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="John Doe" required value="{{ $selectedCourse->course_name }}">
        </div>
    </div>

    <div class="mb-6 flex justify-between items-center gap-3">
        <div class="w-10/12">
            <label for="deskripsi" class="block mb-2 text-sm font-medium dark:text-white">Deskripsi</label>
            <input type="text" id="deskripsi" name="deskripsi"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="John Doe" required value="{{ $selectedCourse->deskripsi }}">
        </div>
    </div>

    <div class="mb-6 flex justify-between items-center gap-3">
        <div class="w-10/12">
            <label for="content" class="block mb-2 text-sm font-medium dark:text-white">Tanggal Selesai</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="John Doe" required value="{{ $selectedCourse->tanggal_selesai }}">
        </div>
    </div>

    <button type="submit"
        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
        Ubah Data
    </button>

    <button type="button"
        onclick="window.location.href='{{ route('admin.contents.index', ['courseId' => $selectedCourse->id]) }}'"
        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none dark:focus:ring-blue-800 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
        Lihat Content
    </button>

</form>
@endsection