@extends('layout.basic')

@section('title')
    Custom DnD
@endsection

@section('content')
  <style media="screen">
    .front {
      background-color: #222;
      padding: 10px 40px 25px 40px;
      border-radius: 30px;
      color: #fff;
      margin: 0px -12px;
    }
    .siteitem {
      overflow: hidden;
      height: 100px;
      width: 150px;
      text-align: center;
      margin: 3px 1px;
      padding: 10px;
    }
    .rightyscroll {
      height: 106px;
      overflow-x: scroll;
      white-space: nowrap;
    }
  </style>
  <div class="container">
    <div class="alert alert-warning" role="alert">
      This is a early Alpha build. Objects and features does not represent final product.
    </div>
    <div class="front">
      <h1>DnD Player Framework<br><small>logged in as: {{Auth::user()->username}}</small></h1>
    </div>
  <br>
    <h4>Active games</h4>
    <div class="rightyscroll">
      @foreach ($data['activegames'] as $key => $game)
        <a class="btn btn-default siteitem" href="/DM/{{$game->id}}">{{$game->name}}</a>
      @endforeach
    </div>
  <hr>
    <h4>Stories</h4>
    <div class="rightyscroll">
      <a class="btn btn-info siteitem" href="/stories">All<br>Stories</a>
      @foreach ($data['storys'] as $key => $story)
        <a class="btn btn-default siteitem" href="/stories/{{$story->id}}">{{$story->name}}<br><small>{{$story->description}}</small></a>
      @endforeach
    </div>
  <hr>
    <h4>Characters</h4>
    <div class="rightyscroll">
      <a class="btn btn-info siteitem" href="/character/new">New<br>Character</a>
      @foreach ($data['characters'] as $key => $profile)
        <a class="btn btn-default siteitem" href="/character/{{$profile->id}}">{{$profile->name}}<br><small>{{$profile->race}}</small></a>
      @endforeach
    </div>
  <hr>
    <h4>Users</h4>
    <div class="rightyscroll">
      <a class="btn btn-info siteitem" href="/user/new">New<br>Character</a>
      @foreach ($data['users'] as $key => $user)
        <a class="btn btn-default siteitem">{{$user->username}}</a>
      @endforeach
      <a class="btn btn-default siteitem" href="/logout">Logout</a>
    </div>
  <br>
</div>
    {{-- <h1>Post Billede</h1>
    {{ Form::open(array('route' => 'postimage', 'files' => true)) }}
        {{ Form::label('Billede') }}
        {{ Form::file('pic') }}
        <br />{{ Form::submit('Udgiv') }}
    {{ Form::close() }} --}}
@endsection
