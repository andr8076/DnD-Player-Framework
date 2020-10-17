<script type="text/javascript">
    @yield('script')

    @if (Session::has('js'))
        $(window).load(function(){
            {{ Session::get('js') }}
        });
    @endif
</script>
