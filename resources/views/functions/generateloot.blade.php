@extends('layout.basic')

@section('title')
  Auto Loot generator
@endsection

@section('content')
<center>
  @if (!empty($loot))
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Number</th>
          <th>Loot</th>
          <th>Specs</th>
          <th>Functions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($loot as $key => $item)
          <tr>
            <td>{{$key+1}}</td>
            <td>[Level {{$item->level}}] {{$item->name}}</td>
            <td>n/a</td>
            <td>
              <select id="giveloot{{$key+1}}" onchange="giveLoot({{$key+1}})" class="form-control" style="width:120px;">
                <option value="0">Give loot:</option>
                @foreach ($players as $key => $player)
                  <option value="{{$player->id}}-{{$item->id}}">Give to {{$player->name}}</option>
                @endforeach
              </select>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <h3>No loot was found</h3>
  @endif
</center>
<script type="text/javascript">
  function giveLoot(selectnumber) {
    var rawdata = $("#giveloot" + selectnumber + " :selected").val();
    data = rawdata.split("-");
    user1 = data[0];
    item1 = data[1];
    $.ajax({
        url: "/giveloot",
        type:"POST",
        data: { character: user1, item: item1, _token: "{{ csrf_token() }}"},
        success:function(data){
          //success code...
          $("#giveloot" + selectnumber + " option[value='" + rawdata + "']").each(function() {
              $(this).remove();
          });
          $("#giveloot" + selectnumber).prop('selectedIndex',0);
        },error:function(ts){
          alert("AJAX error. Please contact the system admin.");
        }
      });
  }
</script>
@endsection
