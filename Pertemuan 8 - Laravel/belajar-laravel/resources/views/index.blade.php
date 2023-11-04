@extends('pertemuan8')
@section('content')
    @foreach ($animals as $items)
        <li>{{$items}}</li>
    @endforeach
@endsection