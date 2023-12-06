@extends('dashboard.template')

@section('header')
Beranda
@endsection

@section('content')
<h3 class="text-3xl font-bold tracking-tight dark:text-white mb-8">
    Daftar Course
</h3>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right dark:text-gray-400 border-b">
        <thead class="text-xs uppercase dark:text-gray-400">
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
                    Pengajar
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($courses as $item)
            <tr class="odd:dark:bg-gray-900 even:dark:bg-gray-800 dark:border-gray-700 hover:brightness-95">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white text-center">
                    {{ $no++ }}
                </th>
                <td class="px-6 py-4 text-center">
                    {{ $item->course_name }}
                </td>
                <td class="px-6 py-4 tect-center">
                    {{ $item->deskripsi }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $item->teacher_name }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection