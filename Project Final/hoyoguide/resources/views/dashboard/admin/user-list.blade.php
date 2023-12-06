@extends('dashboard.template')

@section('header')
Daftar User
@endsection

@section('content')
<div class="mb-8">
    <a href="{{ route('user.create') }}"
        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none dark:focus:ring-blue-800 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
        Tambah User
    </a>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right dark:text-gray-400 border-b">
        <thead class="text-xs uppercase dark:text-gray-400">
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
                <th scope="col" class="px-6 py-3 text-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($users as $item)
            <tr class="odd:dark:bg-gray-900 even:dark:bg-gray-800 dark:border-gray-700 hover:brightness-95">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white text-center">
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
                    class="px-2 py-1 font-semibold leading-tight rounded dark:bg-green-700 dark:text-green-100">
                        {{ ucwords($item->role) }}
                    </span>
                    @endif

                    @if ($item->role == 'teacher')
                    <span
                    class="px-2 py-1 font-semibold leading-tight rounded dark:bg-blue-700 dark:text-blue-100">
                        {{ ucwords($item->role) }}
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4 flex items-center">
                    <a href="/user/{{ $item->id }}/edit"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:focus:ring-yellow-900">
                        Kelola
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection