@extends('layout.default')

@section('title')
    New custom npc
@endsection

@section('content')
<style media="screen">
  .locationname {
    font-size: 25px;
    height: 40px;
  }
</style>
{{ Form::open(array('route' => 'postnewcustomnew', 'files' => true)) }}
{{ Form::hidden('story_id', $id) }}
<div class="container">
  <div class="alert alert-warning" role="alert">
    This feature is early build. Objects and features does not represent final product.<br>Please give feedback to developer, if you wish something to be added.
  </div>
  <div class="row">
    <div class="col-sm-10">
      <h3>New Custom Story NPC</h3>
    </div>
    <div class="col-sm-2">
      {{ Form::submit('Gem', array('class' => 'btn btn-primary btn-block')) }}
    </div>
  </div>

  <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
  {{ Form::text('name', '', array('class' => 'form-control locationname', 'placeholder' => 'NPC Name')) }}
  @if ($errors->has('name'))
      <strong>
          {{ $errors->first('name') }}
      </strong>
  @endif
  </div>

  {{ Form::label('NPC description') }}
  <div class="form-group {{ ($errors->has('text')) ? 'has-error' : '' }}">
    {{ Form::textarea('text', '', array('class' => 'form-control', 'placeholder' => "Write info here", 'style' => 'height:100px;')) }}
    @if ($errors->has('text'))
        <strong>
            {{ $errors->first('text') }}
        </strong>
    @endif
  </div>

  {{ Form::label('NPC image (Max size allowed is 1024x1024 pixels)') }}
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
