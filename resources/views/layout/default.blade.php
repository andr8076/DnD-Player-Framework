<!DOCTYPE html>
<html>
    <head>
      @include('layout.headerlinks')
    </head>
    <body>
      @include('layout.navbar')
      @yield('content')
    </body>
      @include('layout.scripts')
</html>
