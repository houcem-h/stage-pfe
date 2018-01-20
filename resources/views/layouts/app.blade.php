<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stage PFE') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

</head>
<body>
  @if (!Auth::guest())
    @if (Auth::user()->role==1)
      @include('../navbar/teachernav')
    @else
      @include('../navbar/navbar')
    @endif
    @else
      @include('../navbar/navbar')
      
 @endif

@yield('content')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script> -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
$(function() {
  $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd' });
});
</script>
<!-- SCRIPTS AMINE BEJOUI-->
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('js/sweetalert.min.js')}}"></script>
<script src="{{ asset('js/script_group.js')}}"></script>
<script src="{{ asset('js/script_students.js')}}"></script>
<script>
var url_check_group_name = "{{ route('check_group_name') }}";
var url_get_group_name = "{{ route('get_group_name')}}";
var add_group = "{{ route('add_group') }}";
var url_save_update = "{{ route('saveUpdateGroup') }}";
var url_check_id_group = "{{route('check_group')}}";
//for location.href
var url_group = "{{ route('group')}}";
var url_get_students = "{{ route('get_students') }}";
var url_update_group_student = "{{ route('update_Students_Group')}}";
var success;
var token = "{{ Session::token() }}";
</script>
</body>
</html>
