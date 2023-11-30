@extends('dashboard.template')

@section('header')
    Daftar User
@endsection

@section('content')
    <div class="mb-8">
        <a href="{{ route('user-list.create') }}"
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
            Tambah User
        </a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 hover:brightness-95">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $item->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->username }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-4">
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
                        <td class="px-6 py-4 flex items-center">
                            <a href="/user-list/{{ $item->id }}/edit"
                                class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:focus:ring-yellow-900">
                                Kelola
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
