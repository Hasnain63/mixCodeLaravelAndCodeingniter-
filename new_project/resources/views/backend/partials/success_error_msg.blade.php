@if(Session::has('success'))
    <script>
        toastr.options =
            {
                "closeButton": true,
                "progressBar": true,
                "timeOut": 30
            }
        toastr.success("{!!Session::get('success') !!}");
    </script>
@endif

@if(Session::has('error'))
    <script>
        toastr.options =
            {
                "closeButton": true,
                "progressBar": true,
                "timeOut": 30
            }
        toastr.error("{!!Session::get('error') !!}");
    </script>
@endif

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <script>
            toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true,
                    "timeOut": 30
                }
            toastr.error("{{ $error }}");
        </script>
    @endforeach
@endif
