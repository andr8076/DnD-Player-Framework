@extends('layout.home')

@section('title')
    laravel with image
@endsection

@section('content')
    <h4>{{$image}}</h4>
    <img src="/img/{{$image}}.jpg" alt="demo image">
@endsection
