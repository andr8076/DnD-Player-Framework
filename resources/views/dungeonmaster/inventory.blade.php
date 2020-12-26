@extends('layout.basic')

@section('title')
  Player Inventory - {{$game->name}}
@endsection

@section('content')
  <div style="margin:5px;">
    <h3>Player Inventorys</h3>
    <hr>
    <div class="row">
      <div class="col-md-8 col-sm-12">
        <div class="row">
          @foreach ($players as $key => $player)
            <div class="col-md-6 col-xs-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3>{{$player->name}}</h3>
                </div>
                <div class="panel-body">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <select class="form-control" onchange="giveitem({{$player->id}})" name="addItem" id="addItem{{$player->id}}">
                        <option value="0" selected>{{$player->name}} add item</option>
                        <option value="0" disabled>--- General items ---</option>
                        @foreach ($generalitems as $key => $value)
                          <option value="{{$player->id}}.{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                        <option value="0" disabled>--- Custom Story items (coming soon) ---</option>
                        {{-- @foreach ($storyitems as $key => $value)
                          <option value="{{$player->id}}.{{$value->id}}">{{$value->name}}</option>
                        @endforeach --}}
                      </select>
                    </div>
                  </div>
                  <div id="playeritems{{$player->id}}">
                    @foreach ($inventory as $key => $item)
                      @if ($item->character_id == $player->id && $item->active)
                        <div id="playeritem{{$item->id}}" class="panel panel-default">
                          <div class="panel-body">
                            {{$item->getItemName()}}
                            <span onclick="deleteitem({{$item->id}})" class="pull-right"><i class="fa fa-trash"></i></span>
                          </div>
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Trash</h3>
          </div>
          <div class="panel-body">
            @foreach ($inventory as $key => $item)
              @if (!$item->active)
                <div id="playeritem{{$item->id}}" class="panel panel-default">
                  <div class="panel-body">
                    <span class="btn">{{$item->getItemName()}}</span>
                    <span onclick="returnitem({{$item->id}})" class="pull-right btn btn-info">Restore</span>
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function giveitem(playerid) {
      var rawdata = $("#addItem" + playerid + " :selected").val();
      var data = rawdata.split(".");
      var user1 = data[0];
      var item1 = data[1];
      $.ajax({
          url: "/giveloot",
          type:"POST",
          data: { character: user1, item: item1, _token: "{{ csrf_token() }}"},
          success:function(data){
            //success code...
            var playeritems = $("#playeritems" + user1).html();
            $("#playeritems" + user1).html(playeritems + '<div class="panel panel-default"><div class="panel-body">' + $("#addItem" + playerid + " :selected").html() + '<span class="pull-right"><i class="fa fa-sync"></i></span></div></div>');
            $("#addItem" + user1).prop('selectedIndex',0);
          },error:function(ts){
            alert("AJAX error. Please contact the system admin.");
          }
        });
    }
    function deleteitem(id) {
      $.ajax({
          url: "/deleteitem",
          type: "POST",
          data: { deleteid: id, _token: "{{ csrf_token() }}"},
          success:function(data){
            //success code...
            $("#playeritem" + id).remove();
            location.reload();
          },error:function(ts){
            // console.log(ts);
            alert("AJAX error. Please contact the system admin.");
          }
        });
    }
    function returnitem(id) {
      $.ajax({
          url: "/returnitem",
          type: "POST",
          data: { returnid: id, _token: "{{ csrf_token() }}"},
          success:function(data){
            //success code...
            $("#playeritem" + id).remove();
            location.reload();
          },error:function(ts){
            // console.log(ts);
            alert("AJAX error. Please contact the system admin.");
          }
        });
    }
  </script>
@endsection
