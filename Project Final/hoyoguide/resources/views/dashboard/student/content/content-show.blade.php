@extends('dashboard.template')

@section('header')
Detail Content: {{ $content->judul }}
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 shadow-md p-4 rounded-lg mb-4 mt-4">
    <h1 class="text-4xl font-bold mb-2">{{ $content->judul }}</h1>
    <hr class="border-gray-500 my-2">
    <p class="text-md">{{ $content->materi }}</p>
</div>

<form method="POST" action="{{ route('student.contents.complete', ['content' => $content->id]) }}">
    @csrf
    <button type="submit" class="text-green-500 hover:underline mt-2 block">Selesai Belajar</button>
</form>

@endsection