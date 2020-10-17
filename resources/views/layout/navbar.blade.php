<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">DnD Player Framework</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        @php($games = App\Games::where('user_id', Auth::user()->id)->get())
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Active games <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @foreach ($games as $key => $game)
              <li><a href="/DM/{{$game->id}}">{{$game->name}}</a></li>
            @endforeach
          </ul>
        </li>
        @php($stories = App\Story::where('user_id', Auth::user()->id)->get())
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Stories <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @foreach ($stories as $key => $story)
              <li><a href="/stories/{{$story->id}}">{{$story->name}}</a></li>
            @endforeach
          </ul>
        </li>
        @php($characters = App\Character::where('user_id', Auth::user()->id)->get())
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Characters <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @foreach ($characters as $key => $profile)
              <li><a href="/character/{{$profile->id}}">{{$profile->name}}</a></li>
            @endforeach
          </ul>
        </li>
        {{-- <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li> --}}
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Back</a></li>
      </ul>
    </div>
  </div>
</nav>
