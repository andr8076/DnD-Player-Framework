@extends('layout.layout')

@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Laravel8076
            @if (Auth::check())<br>
              <small>Welcome {{Auth::user()->username}}</small>
            @endif
        </div>

        <div class="links">
            @if (Auth::check())
              <a href="/logout">Logout</a>
            @else
              <a href="/login">Login</a>
            @endif
            <a href="/view-uploads">Image Upload</a>
        </div>
    </div>
</div>
@endsection
