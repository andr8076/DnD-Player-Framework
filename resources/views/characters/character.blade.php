@extends('layout.basic')

@section('title')
    Your Character {{$profile->name}}
@endsection

@section('content')
<style media="screen">
  .datacell {
    text-align: center;
    display: -webkit-inline-box;
    margin: 5px;
  }
  .container {
    max-width: 1024px;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-sm-4" >
      <img src="{{$profile->img}}" alt="Profile Image">
    </div>
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-12" style="text-align:center">
          <h1>{{$profile->name}}</h1>
        </div>
        <div class="col-sm-4">
          <u>CLASS & LEVEL: {{$profile->class}} {{$profile->level}}</u>
        </div>
        <div class="col-sm-4">
          <u>EXPERIENCE POINTS: {{$profile->class}} {{$profile->level}}</u>
        </div>
        <div class="col-sm-4">
          <u>PLAYER NAME: {{Auth::user()->username}}</u>
        </div>
        <div class="col-sm-4">
          <u>RACE: {{$profile->race}}</u>
        </div>
        <div class="col-sm-4">
          <u>BACKGROUND: {{$profile->background}}</u>
        </div>
        <div class="col-sm-4">
          <u>CAMPAIGN or PLAYER ID:
            @if (empty($profile->game_id))
              {{$profile->id}}
            @else
              {{$profile->game_id}}
            @endif
          </u>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-1" style="text-align:center">
      Strength
      {{$profile->STR}}
      <br>
      Dexterity
      {{$profile->DEX}}
      <br>
      Constitution
      {{$profile->CON}}
      <br>
      Intelligence
      {{$profile->INE}}
      <br>
      Wisdom
      {{$profile->WIS}}
      <br>
      Charisma
      {{$profile->CHA}}
      <hr>
      @if (empty($profile->game_id))
        {{ Form::open(array('route' => 'postaddplayer')) }}
            {{ Form::label('Add 2 Game') }}
            {{ Form::hidden('chrID', $profile->id) }}
            {{ Form::text('gameid', '', array('class' => 'form-control', 'required' => 'required')) }}
            {{ Form::submit('add', array('class' => 'btn btn-info btn-block')) }}
        {{ Form::close() }}
      @endif
    </div>
    <div class="col-sm-3" >
      +{{$profile->proficiency_bonus}} PROFICIENCY BONUS
    </div>
    <div class="col-sm-4" >
      <br>
      <div class="row">
        <div class="12" style="text-align:center">
          <div class="datacell">
            ARMOR CLASS &nbsp; (AC)<br>{{$profile->AC}}
          </div>
          <div class="datacell">
            INITIATIVE<br>{{$profile->initiative}}
          </div>
          <div class="datacell">
            SPEED<br>{{$profile->speed}} m.
          </div>
        </div>
        <div class="12" style="text-align:center">
          <div class="datacell">
            HIT POINTS<br>{{$profile->hit_points}}
          </div>
          <div class="datacell">
            HIT DICE<br>{{$profile->hit_dice}}
          </div>
          <div class="col-sm-12">
            DEATH SAVES:
          </div>
          <div class="col-sm-6">
            Success: {{$profile->death_saves_success}}/3
          </div>
          <div class="col-sm-6">
            Fail: {{$profile->death_saves_fail}}/3
          </div>
        </div>
      </div>
      <br>
      @foreach ($collums as $key => $collum)
          @if ($collum->side == 0)
            <div class="">
              <h4 style="text-align:center">{{$collum->title}}</h4>
              <hr>
            @foreach ($col_refs[$collum->id] as $key => $col_ref)
              <div class="">
                <h5>{{$col_ref->title}}</h5>
                {{$col_ref->text}}
              </div>
            @endforeach
          </div>
          @endif
      @endforeach
    </div>
    <div class="col-sm-4" >
      @foreach ($collums as $key => $collum)
          @if ($collum->side == 1)
            <div class="">
              <h4 style="text-align:center">{{$collum->title}}</h4>
              <hr>
            @foreach ($col_refs[$collum->id] as $key => $col_ref)
              <div class="">
                <h5>{{$col_ref->title}}</h5>
                {{$col_ref->text}}
              </div>
            @endforeach
          </div>
          @endif
      @endforeach
    </div>
    <div class="col-sm-4" >
        <div class="">
          <h4 style="text-align:center">Inventory</h4>
          <hr>
        @foreach ($items as $key => $item)
          @if ($item->active)
            <div class="">
              - {{$item->getItemName()}}<br>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</div>



  {{-- <style media="screen">
    .special {
      display: inline-block;
      margin: 30px;
      margin-top: 0px;
      font-weight: bold;
    }
    .special > h2 {
      margin-bottom: -10px;
    }
  </style>
  <center>
    <h1>Character: {{$profile->name}}</h1>
    <hr>
      <div class="special">
        <h2>{{$profile->STR}}</h2><br>Strength
      </div>
      <div class="special">
        <h2>{{$profile->PER}}</h2><br>Perception
      </div>
      <div class="special">
        <h2>{{$profile->END}}</h2><br>Endurance
      </div>
      <div class="special">
        <h2>{{$profile->CHR}}</h2><br>Charisma
      </div>
      <div class="special">
        <h2>{{$profile->INE}}</h2><br>Intelligence
      </div>
      <div class="special">
        <h2>{{$profile->AGI}}</h2><br>Agility
      </div>
      <div class="special">
        <h2>{{$profile->LCK}}</h2><br>Luck
      </div>
    <hr>
    <h2>Inventory</h2>
    @foreach ($items as $key => $item)
      - [Level {{$item->level}}] {{$item->getItemName()}}<br>
    @endforeach
  </center> --}}
@endsection
