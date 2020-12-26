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
    .sidepanel::-webkit-scrollbar {
      display: none;
    }
    nav {
      margin-bottom: 0px !important;
    }
    .content {
      width: calc(100vw - 240px);
      height: calc(100vh - 60px);
      float: right;
      min-width: 400px;
      overflow-x: scroll;
      margin-top: 10px;
    }
    .DMblock2 {
      padding: 10px;
      border: solid 1px #d0d0d0;
    }
    .origialstory {
      text-align: center;
      font-weight: bold;
      color: #000;
    }
    .panel-heading > a {
      margin-top: -28px;
    }
    #imgbox {
      text-align: center;
    }
    #storybox > h3 {
      margin-top: 0px;
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
            <li><a href="/DM/{{$game->id}}/loot" onclick="window.open(this.href,'targetWindow',`toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=250`);return false;">Create Loot</a></li>
            <li><a href="/map/{{$game->id}}" target=”_blank”>Map-Site</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">Throw Dice<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a onclick="alert('Dice landed on: ' + (Math.floor(Math.random() * 4) + 1))">4 Sided</a></li>
                <li><a onclick="alert('Dice landed on: ' + (Math.floor(Math.random() * 6) + 1))">6 Sided</a></li>
                <li><a onclick="alert('Dice landed on: ' + (Math.floor(Math.random() * 8) + 1))">8 Sided</a></li>
                <li><a onclick="alert('Dice landed on: ' + (Math.floor(Math.random() * 10) + 1))">10 Sided</a></li>
                <li><a onclick="alert('Dice landed on: ' + (Math.floor(Math.random() * 12) + 1))">12 Sided</a></li>
                <li><a onclick="alert('Dice landed on: ' + (Math.floor(Math.random() * 20) + 1))">20 Sided</a></li>
              </ul>
            </li>
            <li><a href="/inventory/{{$game->id}}" target=”_blank”>Inventorys</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <div class="sidepanel">
    <div class="storyitem" onclick="getstorytitlebox({{$story->id}})">
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
      <div class="col-sm-12 col-md-8 DMblock" {{--style="min-height: 280px"--}}>
        <div class="alert alert-warning" role="alert">
          This is a early Alpha build. Objects and features does not represent final product.<br>
          <b>Phone use is not recommended on this page.</b>
        </div>
        <div class="panel panel-default">
          <div class="panel-body" id="storybox">
            <h3>{{$story->name}}</h3><hr>{{$story->description}}
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 hidden-xs DMblock" id="imgbox">
        <div class="panel panel-default">
          <img src="#" style="max-height:280px;max-width:300px;"  id="map-img" alt="">
        </div>
      </div>
      <div class="col-md-12 col-sm-12 DMblock">
        {{-- <div class="panel panel-default">
          <div class="panel-body">
            <h4>Note:</h4><hr>
            <span id="Notebox"></span>
          </div>
        </div> --}}
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12 DMblock">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Players</h4>
          </div>
          <div class="panel-body" id="PlayerBox">
            @foreach ($players as $key => $player)
              <div class="panel panel-default">
                <div class="panel-body">
                  <a href="/character/{{$player->id}}">{{$player->name}}</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12 DMblock">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Story NPC's</h4><a class="pull-right" href="/stories/npc/new/{{$game->id}}"><i class="fa fa-plus"></i></a>
          </div>
          <div class="panel-body" id="NPCBox">
            @foreach ($npc as $key => $value)
              <div class="panel panel-default">
                <div class="panel-body">
                  {{$value->name}}
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6  col-xs-12 DMblock">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Story Items</h4><a class="pull-right" href="/stories/item/new/{{$game->id}}"><i class="fa fa-plus"></i></a>
          </div>
          <div class="panel-body" id="ItemBox">
            @foreach ($items as $key => $value)
              <div class="panel panel-default">
                <div class="panel-body">
                  {{$value->name}}
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  var panel = '';
  function getstorytitlebox(id) {
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
       url: '/getDMStoryBox/' + id,
       type: 'get',
       dataType: 'json',
       success: function(response){
         $('#storybox').html("<h3>" + response['title'] + "</h3><hr>" + response['storytext']);
       }
     });
     updatemapimg(id);
     // getstoryNote(id);
  }
  function updatemapimg(id) {
    var src = $('#map' + id).attr('src');
    if (!src) {
      $("#map-img").attr("src", '');
    } else {
      $("#map-img").attr("src", src);
    }
  }
  // function getstoryNPC(id) {
  //   panel = '';
  //    $.ajax({
  //      url: '/getDMStoryNPC/' + id,
  //      type: 'get',
  //      dataType: 'json',
  //      success: function(response){
  //        response.forEach(NPCforeach);
  //        $('#NPCBox').html(panel);
  //      }
  //    });
  // }
  // function getstoryItem(id) {
  //   panel = '';
  //    $.ajax({
  //      url: '/getDMStoryItem/' + id,
  //      type: 'get',
  //      dataType: 'json',
  //      success: function(response){
  //        response.forEach(Itemforeach);
  //        $('#ItemBox').html(panel);
  //      }
  //    });
  // }
  // function getstoryNote(id) {
  //   panel = '';
  //    $.ajax({
  //      url: '/getDMStoryNote/' + id,
  //      type: 'get',
  //      dataType: 'json',
  //      success: function(response){
  //        if (response != "") {
  //           $('#NoteBox').html(response);
  //        } else {
  //           $('#NoteBox').html("<span style='font-style: italic;'>No notes here...</span>");
  //        }
  //      }
  //    });
  // }

  //--- foreach START
  function NPCforeach(item, index) {
    panel = panel + ("<div class='panel panel-default'><div class='panel-body'>" + item['name'] + "</div></div>");
  }
  function Itemforeach(item, index) {
    panel = panel + ("<div class='panel panel-default'><div class='panel-body'>" + item['name'] + "</div></div>");
  }
  //--- foreach END
  $( document ).ready(function() {
    getstoryNPC({{$game->id}});
    getstoryItem({{$game->id}});
    // getstorytitlebox({{$game->id}});
  });
  </script>
@endsection
