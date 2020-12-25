@extends('layout.basic')

@section('title')
  {{$game->name}} - Map
@endsection

@section('content')
  <style media="screen">
    body {
      background-color: rgb(14, 14, 14);
    }
    #img {
      width: 100%;
      height: 100vh;
      background-image: none;
      background-repeat: no-repeat;
      background-size: contain;
      background-position: center;
    }
  </style>

  <div id="img"></div>

  <script type="text/javascript">
    var img = '';
    function getstoryItem(id) {
       $.ajax({
         url: '/getDMStoryImg/' + id,
         type: 'get',
         dataType: 'json',
         success: function(response){
           if (response != img) {
             $('#img').css('background-image', "url('/" + response + "'");
             img = response;
           }
         }
       });
    }
    setInterval(function(){
     	getstoryItem({{$game->id}});
    }, 3000);
  </script>
@endsection
