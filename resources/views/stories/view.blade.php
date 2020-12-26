@extends('layout.default')

@section('title')
  {{$story->name}}
@endsection

@section('content')
  <style media="screen">
    .storyitem {
      background-color: #cacaca;
      border-radius: 5px;
      padding: 0px;
      margin: 5px;
      display: inline-grid;
      width: 210px;
      height: 140px;
      text-decoration: none !important;
    }
    .storytitle {
      color: grey;
      overflow: hidden;
      padding: 0px 10px;
    }
    .storytitle > span {
      font-weight: bold;
      color: #000;
    }
    .storyitem > img {
      height: 110px;
      width: 210px;
      margin-bottom: 4px;
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }
    .newlocation {
      font-size: 60px;
      color: grey;
      padding-top: 30px;
      margin: 0 auto;
      margin-bottom: 20px;
    }
    .newlocation :hover {
      color: grey;
    }
    .nosidepadding {
      padding: 0px;
    }
  </style>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-9">
          <h3>{{$story->name}} <small>{{$story->description}}</small></h3>
        </div>
        <div class="col-sm-3">
          <a class="btn btn-danger pull-right" href="/delete/stories/{{$story->id}}">Delete Story</a>
          <a class="btn btn-info pull-right" onclick="alert('comming soon');" href="#">Edit Order</a>
          <a class="btn btn-success pull-right" href="/DM/active/{{$story->id}}">Make active game</a>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <h3><hr>Locations</h3>
      <div class="row">
        @foreach ($locations as $key => $value)
          <div class="col-sm-4 col-md-3 nosidepadding">
            <div class="" style="display: inline-block;">
              <a href="/stories/locations/{{$value->id}}" class="storyitem">
                @if ($value->img != null)
                  <img src="{{$value->img}}" loading="lazy" alt="">
                @else
                  <i class="fa fa-map-signs newlocation"></i>
                @endif
                <div class="storytitle">
                  <span>#{{$value->story_order}}</span>  {{$value->title}}
                </div>
              </a>
              <i class="fa fa-arrow-right"></i>
            </div>
          </div>
        @endforeach
        <div class="col-sm-4 col-md-3 nosidepadding">
          <a href="/stories/locations/new/{{$story->id}}" class="storyitem">
            <i class="fa fa-plus newlocation"></i>
            <div class="storytitle text-center">
              <span>New</span>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <hr>
      <div class="row">
        <div class="col-xs-9">
          <h3>Story Items</h3>
        </div>
        <div class="col-xs-3">
          <a class="btn btn-info" href="/stories/item/new/{{$story->id}}">New Item</a>
        </div>
      </div>
      @if (empty($items))
        <h4>There is no items</h4>
      @endif
      @foreach ($items as $key => $value)
        <a href="/stories/item/{{$value->id}}" class="btn btn-default btn-block">{{$value->name}}</a>
      @endforeach
    </div>
    <div class="col-xs-12 col-sm-6">
      <hr>
      <div class="row">
        <div class="col-xs-9">
          <h3>Story NPC's</h3>
        </div>
        <div class="col-xs-3">
          <a class="btn btn-info" href="/stories/npc/new/{{$story->id}}">New NPC</a>
        </div>
      </div>
      @if (empty($items))
        <h4>There is no npc's</h4>
      @endif
      @foreach ($npc as $key => $value)
        <a href="/stories/npc/{{$value->id}}" class="btn btn-default btn-block">{{$value->name}}</a>
      @endforeach
    </div>
  </div>
</div>
@endsection
