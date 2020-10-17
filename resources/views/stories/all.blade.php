@extends('layout.default')

@section('title')
  All your amazing stories
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-xs-0"></div>
    <div class="col-sm-4">
      <a class="btn btn-info btn-block" href="/stories/new">New<br>Stories</a>
      @foreach ($stories as $key => $story)
        <a class="btn btn-default btn-block" href="/stories/{{$story->id}}">{{$story->name}} <br> <small>{{$story->description}}</small></a>
      @endforeach
    </div>
    <div class="col-sm-4 col-xs-0"></div>
  </div>
</div>
@endsection
