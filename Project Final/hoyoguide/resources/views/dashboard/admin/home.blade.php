@extends('dashboard.template')

@section('header')
Beranda
@endsection

@section('content')
<h3 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white mb-8">
    Daftar User
</h3>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-b">
        <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    No.
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Username
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Role
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($users as $item)
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 hover:brightness-95">
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                    {{ $no++ }}
                </th>
                <td class="px-6 py-4 text-center">
                    {{ $item->name }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $item->username }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $item->email }}
                </td>
                <td class="px-6 py-4 text-center">
                    @if ($item->role == 'student')
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-800 bg-green-300 rounded dark:bg-green-700 dark:text-green-100">
                        {{ ucwords($item->role) }}
                    </span>
                    @endif

                    @if ($item->role == 'teacher')
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-blue-800 bg-blue-300 rounded dark:bg-blue-700 dark:text-blue-100">
                        {{ ucwords($item->role) }}
                    </span>
                    @endif

                    @if ($item->role == 'admin')
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-red-800 bg-red-300 rounded dark:bg-red-700 dark:text-red-100">
                        {{ ucwords($item->role) }}
                    </span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection