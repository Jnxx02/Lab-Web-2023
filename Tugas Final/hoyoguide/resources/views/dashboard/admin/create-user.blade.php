@extends('dashboard.template')

@section('header')
Tambah User
@endsection

@section('content')
<form method="POST" action="{{ route('user') }}">
    @csrf
    <div class="mb-6 flex justify-between items-center gap-3">
        <div class="w-10/12">
            <label for="name" class="block mb-2 text-sm font-medium dark:text-white">Name</label>
            <input type="text" id="name" name="name"
                class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="John Doe" required>
        </div>

        <div class="w-2/12">
            <label for="role" class="block mb-2 text-sm font-medium dark:text-white">
                Role
            </label>
            <select id="role" name="role"
                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="student" selected>Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    </div>
    <div class="mb-6">
        <label for="username" class="block mb-2 text-sm font-medium dark:text-white">Username</label>
        <input type="text" id="username" name="username"
            class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            placeholder="jndoeee" required>
    </div>

    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium dark:text-white">Email</label>
        <input type="email" id="email" name="email"
            class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            placeholder="name@flowbite.com" required>
    </div>

    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium dark:text-white">Password</label>
        <input type="password" id="password" name="password"
            class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            placeholder="********" required>
    </div>

    <div class="mb-6">
        <label for="password_confirmation" class="block mb-2 text-sm font-medium dark:text-white">Password
            Confirmation</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
            class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            placeholder="••••••••" required>
    </div>

    {{-- <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
            <input id="terms" type="checkbox" value=""
                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                required>
        </div>
        <label for="terms" class="ms-2 text-sm font-medium dark:text-gray-300">I agree with the <a
                href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a></label>
    </div> --}}

    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Tambah User
    </button>

    <a href="{{ route('user') }}"
        class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-500">
        Batal
    </a>
</form>
@endsection