@extends('dashboard.template')

@section('header')
Daftar Course
@endsection

@section('content')
<div class="mb-8">
    @include('dashboard.teacher.create-course')
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-center">
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Course
                </th>
                <th scope="col" class="px-6 py-3">
                    Deskripsi
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal Mulai
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal Selesai
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah Peserta
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($course as $item)
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 hover:brightness-95">
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                    {{ $no++ }}
                </th>
                <td class="px-6 py-4 text-center">
                    {{ $item->course_name }}
                </td>
                <td class="px-6 py-4 tect-center">
                    {{ $item->deskripsi }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $item->tanggal_mulai }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $item->tanggal_selesai }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $item->participant_count }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection