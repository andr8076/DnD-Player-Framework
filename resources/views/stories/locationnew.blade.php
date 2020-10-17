@extends('layout.default')

@section('title')
  New Location
@endsection

@section('content')
<style media="screen">
  .locationname {
    font-size: 30px;
    height: 50px;
  }
</style>
{{ Form::open(array('route' => 'postnewlocations', 'files' => true)) }}
{{ Form::hidden('id', $story->id) }}
<div class="container">
  <div class="row">
    <div class="col-sm-10">
      <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
      {{ Form::text('title', '', array('class' => 'form-control locationname', 'placeholder' => 'Location Name')) }}
      @if ($errors->has('title'))
          <strong>
              {{ $errors->first('title') }}
          </strong>
      @endif
      </div>    </div>
    <div class="col-sm-2">
      {{ Form::submit('Gem', array('class' => 'btn btn-primary btn-block')) }}
    </div>
  </div>

  {{ Form::label('Story text') }}
  <div class="form-group {{ ($errors->has('text')) ? 'has-error' : '' }}">
    {{ Form::textarea('text', '', array('class' => 'form-control', 'style' => 'height:150px;')) }}
    @if ($errors->has('text'))
        <strong>
            {{ $errors->first('text') }}
        </strong>
    @endif
  </div>

  {{ Form::label('Map/Image') }}
  <div class="form-group {{ ($errors->has('image')) ? 'has-error' : '' }}">
    {{ Form::file('image', array('class' => 'form-control')) }}
  @if ($errors->has('image'))
      <strong>
          {{ $errors->first('image') }}
      </strong>
  @endif
  </div>

</div>
{{ Form::close() }}
@endsection
