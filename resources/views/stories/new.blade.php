@extends('layout.basic')

@section('title')
  New Story
@endsection

@section('content')
  <style media="screen">
    .storyname {
      font-size: 40px;
      height: 60px;
    }
  </style>
{{ Form::open(array('route' => 'postnewstory', 'files' => true)) }}
  <div class="container">
    <h1>New Story</h1>
    <br>
    <div class="row">
      <div class="col-sm-8 col-xs-12">
        {{ Form::label('Story Name') }}
        <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
          {{ Form::text('name', '', array('class' => 'form-control storyname')) }}
        @if ($errors->has('name'))
            <strong>
                {{ $errors->first('name') }}
            </strong>
        @endif
        </div>
        {{ Form::label('Story Description') }}
        <div class="form-group {{ ($errors->has('desc')) ? 'has-error' : '' }}">
          {{ Form::text('desc', '', array('class' => 'form-control')) }}
        @if ($errors->has('desc'))
            <strong>
                {{ $errors->first('desc') }}
            </strong>
        @endif
        </div>
      </div>
      <div class="col-sm-4 col-xs-12">
        {{ Form::label('Image') }}
        <div class="form-group {{ ($errors->has('image')) ? 'has-error' : '' }}">
          {{ Form::file('image', array('class' => 'form-control')) }}
        @if ($errors->has('image'))
            <strong>
                {{ $errors->first('image') }}
            </strong>
        @endif
        </div>
      </div>
      <div class="col-xs-12">
        {{ Form::submit('Save', array('class' => 'btn btn-primary btn-block')) }}
      </div>
    </div>
  </div>
{{ Form::close() }}
@endsection
