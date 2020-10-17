@extends('layout.basic')

@section('title')
    Character info for {{$character->name}}
@endsection

@section('content')
<style media="screen">
  .contentcenter {
    text-align: center;
  }
  .smaller {
    width: 95%;
    margin: 0 auto;
  }
  iframe {
    width: 98%;
    height: 70vh;
    border: solid 2px grey;
    border-radius: 5px;
    margin: 0px 12px;
  }
  .iframeparent {
    padding-left: 0px;
    margin-left: 0px;
  }
  .rawcontainer {
    margin-left: 10px;
    margin-right: 10px;
  }
</style>

<div class="rawcontainer">
  <div class="row">
    <div class="col-sm-12">
      <h2>New Character: {{$character->name}} <small>By {{Auth::user()->username}}<br>Step 2: Content</small></h2>
      <hr>
    </div>
    <div class="col-xs-12 col-sm-4 contentcenter">
      <div class="smaller">
        <button onclick="reloadiframe();" class="btn btn-primary btn-block">Refresh Preview</button>
        <h4 class="pull-left">Add boxs</h4>
        {{ Form::open(array('route' => 'characterbox', "id" => "boxcreate")) }}
          {{ Form::hidden('CharacterID', $character->id) }}
          {{ Form::text('title', '', array('class' => 'form-control', 'id' => 'box_title')) }}
          {{ Form::select('side', array("null" => 'Select a Side', '0' => 'Left', '1' => 'Right'), '', array('class' => 'form-control', 'id' => 'box_side'))}}
        {{ Form::close() }}

        <button onclick="postbox();" class="btn btn-primary">test</button>
        <hr>
        <h4 class="pull-left">Add content to box</h4>
        {{ Form::open(array('route' => 'charactercontent', "id" => "boxcontent")) }}
          {{ Form::select('box_id', array(), '', array('class' => 'form-control', 'id' => 'content_id'))}}
          {{ Form::select('style', array("null" => 'Select a style', '0' => 'standard', '1' => 'boxed'), '', array('class' => 'form-control', 'id' => 'content_style'))}}

          {{ Form::text('title', '', array('class' => 'form-control', 'id' => 'content_title')) }}
          {{ Form::textarea('text', '', array('class' => 'form-control', 'id' => 'content_text', 'style' => 'height:100px;')) }}
        {{ Form::close() }}

        <button onclick="postcontent();" class="btn btn-primary">test</button>
        <a href="/" class="btn btn-primary btn-block">Finish Character</a>
      </div>
    </div>
    <div class="col-xs-12 col-sm-8 contentcenter iframeparent">
      <iframe id="CharacterPreview" loading="eager" src="{{url("/character/".$character->id)}}"></iframe>
    </div>
    <div class="col-xs-12">
      <br><br><br>delete/edit in box's and content coming soon here
    </div>
  </div>
</div>

<script type="text/javascript">
  function reloadiframe() {
    document.getElementById("CharacterPreview").contentDocument.location.reload(true);
  }
  function updateboxselect() {
     $.ajax({
       url: '/getboxlist/' + {{$character->id}},
       type: 'get',
       dataType: 'json',
       success: function(response){
         $('#content_id').empty().append('<option value="null">Choose box</option>');
         response.forEach(fillboxselect);
       }
     });
  }
  function fillboxselect(value, key) {
    var temp = value.split(":");
    $('#content_id').append('<option value="' + temp[0] + '">' + temp[1] + '</option>');
  }
  function postbox() {
    $.ajax({
        url: "/characterbox",
        type:"POST",
        data: $('#boxcreate').serialize(),
        success:function(data){ // Success
          $("#box_side").prop('selectedIndex',0);
          $("#box_title").val('');
          updateboxselect();
          reloadiframe();
        },error:function(){ // Fail
          alert("AJAX error. Please contact the system admin.");
        }
    });
  }
  function postcontent() {
    $.ajax({
        url: "/charactercontent",
        type:"POST",
        data: $('#boxcontent').serialize(),
        success:function(data){ // Success
          $("#content_id").prop('selectedIndex',0);
          $("#content_title").val('');
          $("#content_style").prop('selectedIndex',0);
          $("#content_text").val('');
          reloadiframe();
        },error:function(){ // Fail
          alert("AJAX error. Please contact the system admin.");
        }
    });
  }
  $( document ).ready(function() {
    updateboxselect();
  });
</script>
@endsection
