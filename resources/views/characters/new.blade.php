@extends('layout.default')

@section('title')
    New Character
@endsection

@section('content')
  <style media="screen">
    .container {
      max-width: 900px;
      margin: 0 auto;
    }
  </style>

<div class="container">
  {{ Form::open(array('route' => 'postnewcharacter', 'files' => true)) }}
      <h2>New Character<br><small>Step 1: General information</small></h2>
      <div class="row">
          <div class="col-xs-2">
              {{ Form::label('STR') }}
              <div class="form-group {{ ($errors->has('str')) ? 'has-error' : '' }}">
                {{ Form::text('str', '', array('class' => 'form-control')) }}
              @if ($errors->has('str'))
                  <strong>
                      {{ $errors->first('str') }}
                  </strong>
              @endif
              </div>
          </div>
          <div class="col-xs-2">
              {{ Form::label('DEX') }}
              <div class="form-group {{ ($errors->has('dex')) ? 'has-error' : '' }}">
                {{ Form::text('dex', '', array('class' => 'form-control')) }}
              @if ($errors->has('dex'))
                  <strong>
                      {{ $errors->first('dex') }}
                  </strong>
              @endif
              </div>
          </div>
          <div class="col-xs-2">
              {{ Form::label('CON') }}
              <div class="form-group {{ ($errors->has('con')) ? 'has-error' : '' }}">
                {{ Form::text('con', '', array('class' => 'form-control')) }}
              @if ($errors->has('con'))
                  <strong>
                      {{ $errors->first('con') }}
                  </strong>
              @endif
              </div>
          </div>
          <div class="col-xs-2">
              {{ Form::label('INT') }}
              <div class="form-group {{ ($errors->has('ine')) ? 'has-error' : '' }}">
                {{ Form::text('ine', '', array('class' => 'form-control')) }}
              @if ($errors->has('ine'))
                  <strong>
                      {{ $errors->first('ine') }}
                  </strong>
              @endif
              </div>
          </div>
          <div class="col-xs-2">
              {{ Form::label('WIS') }}
              <div class="form-group {{ ($errors->has('wis')) ? 'has-error' : '' }}">
                {{ Form::text('wis', '', array('class' => 'form-control')) }}
              @if ($errors->has('wis'))
                  <strong>
                      {{ $errors->first('wis') }}
                  </strong>
              @endif
              </div>
          </div>
          <div class="col-xs-2">
              {{ Form::label('CHA') }}
              <div class="form-group {{ ($errors->has('cha')) ? 'has-error' : '' }}">
                {{ Form::text('cha', '', array('class' => 'form-control')) }}
              @if ($errors->has('cha'))
                  <strong>
                      {{ $errors->first('cha') }}
                  </strong>
              @endif
              </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Image') }}
            <div class="form-group {{ ($errors->has('image')) ? 'has-error' : '' }}">
              {{ Form::file('image', array('class' => 'form-control')) }}
            @if ($errors->has('image'))
                <strong>
                    {{ $errors->first('image') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Name') }}
            <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
              {{ Form::text('name', '', array('class' => 'form-control')) }}
            @if ($errors->has('name'))
                <strong>
                    {{ $errors->first('name') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Race') }}
            <div class="form-group {{ ($errors->has('race')) ? 'has-error' : '' }}">
              {{ Form::text('race', '', array('class' => 'form-control')) }}
            @if ($errors->has('race'))
                <strong>
                    {{ $errors->first('race') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Class') }}
            <div class="form-group {{ ($errors->has('class')) ? 'has-error' : '' }}">
              {{ Form::text('class', '', array('class' => 'form-control')) }}
            @if ($errors->has('class'))
                <strong>
                    {{ $errors->first('class') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Background') }}
            <div class="form-group {{ ($errors->has('background')) ? 'has-error' : '' }}">
              {{ Form::text('background', '', array('class' => 'form-control')) }}
            @if ($errors->has('background'))
                <strong>
                    {{ $errors->first('background') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('speed') }}
            <div class="form-group {{ ($errors->has('speed')) ? 'has-error' : '' }}">
              {{ Form::text('speed', '', array('class' => 'form-control')) }}
            @if ($errors->has('speed'))
                <strong>
                    {{ $errors->first('speed') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Level') }}
            <div class="form-group {{ ($errors->has('level')) ? 'has-error' : '' }}">
              {{ Form::text('level', '', array('class' => 'form-control')) }}
            @if ($errors->has('level'))
                <strong>
                    {{ $errors->first('level') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Initiative') }}
            <div class="form-group {{ ($errors->has('inti')) ? 'has-error' : '' }}">
              {{ Form::text('inti', '', array('class' => 'form-control')) }}
            @if ($errors->has('inti'))
                <strong>
                    {{ $errors->first('inti') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('proficiency_bonus') }}
            <div class="form-group {{ ($errors->has('pbonus')) ? 'has-error' : '' }}">
              {{ Form::text('pbonus', '', array('class' => 'form-control')) }}
            @if ($errors->has('pbonus'))
                <strong>
                    {{ $errors->first('pbonus') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Hit Points') }}
            <div class="form-group {{ ($errors->has('hitp')) ? 'has-error' : '' }}">
              {{ Form::text('hitp', '', array('class' => 'form-control')) }}
            @if ($errors->has('hitp'))
                <strong>
                    {{ $errors->first('hitp') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('Hit Dice') }}
            <div class="form-group {{ ($errors->has('hdice')) ? 'has-error' : '' }}">
              {{ Form::text('hdice', '', array('class' => 'form-control')) }}
            @if ($errors->has('hdice'))
                <strong>
                    {{ $errors->first('hdice') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
          <div class="col-xs-12 col-sm-6">
            {{ Form::label('AC') }}
            <div class="form-group {{ ($errors->has('ac')) ? 'has-error' : '' }}">
              {{ Form::text('ac', '', array('class' => 'form-control')) }}
            @if ($errors->has('ac'))
                <strong>
                    {{ $errors->first('ac') }}
                </strong>
            @endif
            </div>
            <br>
          </div>
      </div>
      <br>
      {{ Form::submit('Step 2', array('class' => 'btn btn-primary')) }}
  {{ Form::close() }}
</div>
@endsection
