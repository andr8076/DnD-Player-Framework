@extends('layout.layout')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
      <h2 class="card-header w-100 m-1 text-center">Upload Image</h2>
  </div>
  <div class="row justify-content-center">
  {{-- enctype attribute is important if your form contains file upload --}}
  {{-- Please check https://www.w3schools.com/tags/att_form_enctype.asp for further info --}}
      <form class="m-2" method="post" action="/file-upload" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
{{--                <label for="name">File Name</label>--}}
              <input type="text" class="form-control" id="name" placeholder="Enter file Name" name="name">
          </div>
          <div class="form-group">
              <label for="image">Choose Image</label>
              <input id="image" type="file" name="image">
          </div>
          <button type="submit" class="btn btn-dark d-block w-75 mx-auto">Upload</button>
      </form>
  </div>
  {{-- @include('components.errors') --}}
</div>

<hr>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="cs-p-1">Name</th>
                <th class="cs-p-1">URL</th>
            </tr>
        </thead>

        @if (empty($images[0]))
          <p>No Images at the moment</p>
        @else
          @foreach ($images as $image)
            <tr>
                <td class="cs-p-1">{{ $image->name }}</td>
                <td class="cs-p-1"><a href="{{ $image->url }}">View Image</a></td>
            </tr>
          @endforeach
        @endif
    </table>
</div>
@endsection
