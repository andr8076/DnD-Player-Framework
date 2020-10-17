@extends('layout.default')

@section('title')
  {{$item->title}}
@endsection

@section('content')
  <style media="screen">
    .locationname {
      font-size: 30px;
      height: 50px;
    }
  </style>
{{ Form::open(array('route' => 'postlocations', 'files' => true)) }}
{{ Form::hidden('id', $item->id) }}
{{ Form::hidden('story_id', $item->story_id) }}
<div class="container">
  <div class="row">
    <div class="col-sm-10">
      <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
      {{ Form::text('title', $item->title, array('class' => 'form-control locationname', 'placeholder' => 'Location Name')) }}
      @if ($errors->has('title'))
          <strong>
              {{ $errors->first('title') }}
          </strong>
      @endif
      </div>
    </div>
    <div class="col-sm-2">
      {{ Form::submit('Gem', array('class' => 'btn btn-primary btn-block')) }}
    </div>
  </div>

  {{ Form::label('Story text') }}
  <div class="form-group {{ ($errors->has('text')) ? 'has-error' : '' }}">
    {{ Form::textarea('text', $item->storytext, array('class' => 'form-control', 'style' => 'height:150px;')) }}
    @if ($errors->has('text'))
        <strong>
            {{ $errors->first('text') }}
        </strong>
    @endif
  </div>

  {{ Form::label('Replace Map/Image') }}
  <div class="form-group {{ ($errors->has('image')) ? 'has-error' : '' }}">
    {{ Form::file('image', array('class' => 'form-control')) }}
  @if ($errors->has('image'))
      <strong>
          {{ $errors->first('image') }}
      </strong>
  @endif
  </div>


  @if (empty($item->img))
    <h1>No Image</h1>
  @else
    <img src="{{$item->img}}" width="100%" alt="">
  @endif

  <br><br>
  <a href="/delete/stories/locations/{{$item->story_id}}/{{$item->id}}" class="btn btn-danger btn-block">Delete location</a>
  <br><br>

</div>
{{ Form::close() }}
@endsection
