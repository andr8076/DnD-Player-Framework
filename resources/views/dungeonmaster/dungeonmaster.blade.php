@extends('layout.basic')

@section('title')
  {{$game->name}} - Dungeon Master Site
@endsection

@section('content')
  <style media="screen">
    body {
      min-width: 650px;
      overflow-x: scroll;;
    }
    .storyitem {
      background-color: #e8e7e7;
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
    .sidepanel {
      width: 220px;
      background: #222;
      overflow: scroll;
      height: calc(100vh - 50px);
      float: left;
    }
    nav {
      margin-bottom: 0px !important;
    }
    .content {
      width: calc(100vw - 220px);
      height: calc(100vh - 50px);
      float: right;
      min-width: 400px;
      overflow-x: scroll;
    }
    .DMblock {
      padding: 10px;
      border: solid 1px #d0d0d0;
    }
    .origialstory {
      text-align: center;
      font-weight: bold;
      color: #000;
    }
  </style>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="javascript:void(0)">Room: <b>{{$game->name}}</b></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">Players <span class="caret"></span></a>
              <ul class="dropdown-menu">
                @foreach ($players as $key => $player)
                  <li><a href="javascript:void(0)">{{$player->name}}</a></li>
                @endforeach
              </ul>
            </li>

            <li><a href="/DM/{{$game->id}}/loot" onclick="window.open(this.href,'targetWindow',`toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=250`);return false;">Create Loot</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <div class="sidepanel">
    <div class="storyitem" onclick="getOGstorybox({{$story->id}})">
        <i class="fa fa-book-open newlocation"></i>
      <div class="storytitle origialstory">
        {{$story->name}}
      </div>
    </div>
    @foreach ($locations as $key => $value)
      @php
        $imgs = array();
        $imgs[$key] = $value->img;
      @endphp
      <div class="storyitem" onclick="updatestorybox({{$value->id}})">
        @if ($value->img != null)
          <img src="{{$value->img}}" id="map{{$value->id}}" loading="lazy" alt="">
        @else
          <i class="fa fa-map-signs newlocation"></i>
        @endif
        <div class="storytitle">
          <span>#{{$value->story_order}}</span>  {{$value->title}}
        </div>
      </div>
    @endforeach
    <br>
  </div>
  <div class="content">
    <div class="row" style="margin: 0px;">
      <div class="col-sm-12 col-md-8 DMblock" style="min-height: 280px">
        <h5 id="storybox">{{$story->name}}<br>{{$story->description}}</h5>
      </div>
      <div class="col-md-4  hidden-sm hidden-xs">
        <img src="" style="max-height:280px;max-width:300px;"  id="map-img" alt="">
      </div>
      <div class="col-md-4 col-sm-12 DMblock">

      </div>
      <div class="col-md-4 col-sm-6  col-xs-12 DMblock">

      </div>
      <div class="col-md-4 col-sm-6  col-xs-12 DMblock">

      </div>
    </div>
  </div>
  <script type="text/javascript">
  function getOGstorybox(id) {
    $("#map-img").attr("src", '');
    $('#storybox').text("Loading...");
     $.ajax({
       url: '/getDMStory/' + id,
       type: 'get',
       dataType: 'json',
       success: function(response){
         $('#storybox').text(response);
       }
     });
  }
  function updatestorybox(id) {
    $('#storybox').text("Loading...");
     $.ajax({
       url: '/getDMStoryitem/' + id,
       type: 'get',
       dataType: 'json',
       success: function(response){
         $('#storybox').text(response);
       }
     });
     updatemapimg(id);
  }
  function updatemapimg(id) {
    var src = $('#map' + id).attr('src');
    if (!src) {
      $("#map-img").attr("src", '');
    } else {
      $("#map-img").attr("src", src);
    }
  }
  </script>
@endsection
