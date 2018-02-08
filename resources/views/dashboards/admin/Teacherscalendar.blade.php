<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
	<link rel="shortcut icon" href="{{ asset('dashboard_assets/img/favicon.png') }}">
	<title>{{ config('app.name', 'Stage PFE') }}</title>
	<script src="{{ asset('dashboard_assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
	<!-- Icons -->
	<link href="{{ asset('dashboard_assets/node_modules/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('dashboard_assets/node_modules/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Main styles for this application -->
	{{--  AMINE BEJAOUI MODIFICATIONS--}}
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	{{--  END MODIFICATIONS--}}
	<!-- Styles required by this views -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="{{ asset('dashboard_assets/node_modules/calendar/fullcalendar.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
  <link href="http://kouki.website/vendor/koukicons/koukicons.min.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
  <style>
	  * {
		font-family: 'Raleway', sans-serif;
	  }
	  .active{
		  padding: 8px !important;
	  }
  </style>
</head>


  @if (!Auth::guest())
    @if (Auth::user()->role==1)
      @include('navbar/teachernav')
    @else
      @include('navbar/navbar')
    @endif
    @else
      @include('navbar/navbar')

 @endif

<body class="">
	<div class="container">








	<div class="col-lg-8 col-md-8 col-lg-offset-2">
      <div class="card">
          <div class="card-header" data-background-color="bleu">
              <h4 class="title">Calendrier de soutenances  </h4>
              <p class="category"></p>
          </div>
          <div class="card-content ">

						<script>


								$(document).ready(function() {

									$('#calendar').fullCalendar({
										locale: 'fr',
										header: {
											left: 'prev,next today',
											center: 'title',
											right: 'listDay,listWeek,month'
										},

										// customize the button names,
										// otherwise they'd all just say "list"
										views: {
											listDay: { buttonText: 'liste de jour' },
											listWeek: { buttonText: 'liste de semaines' }
										},

										defaultView: 'listWeek',
										defaultDate: "{{$first}}",
										navLinks: true, // can click day/week names to navigate views
										editable: true,
										eventLimit: true, // allow "more" link when too many events
										events: [{!! $jscode !!}]
									});

								});

									</script>

						<div id='calendar'></div>

            </div>

<a class="card-footer  pull-right btn sendbtn" href="{{route("soutenancespdf")}}">Telecharge </a>

          <a href= "{{ URL::previous() }}">
              <button class="btn deletebtn" style="width:100px;color:snow;background-color:#f26058">Retour</button>
          </a>

        </div>
          </div>


				</div>






	<!-- Bootstrap and necessary plugins -->

	<script src="{{ asset('dashboard_assets/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
	<script src="{{ asset('dashboard_assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('dashboard_assets/node_modules/pace-progress/pace.min.js') }}"></script>

	<!-- Plugins and scripts required by all views -->
	<script src="{{ asset('dashboard_assets/node_modules/chart.js/dist/Chart.bundle.js') }}"></script>

	<!-- CoreUI main scripts -->

	<script src="{{ asset('dashboard_assets/js/app.js') }}"></script>
	<script src="{{ asset('dashboard_assets/node_modules/moment/moment.js') }}"></script>
	<script src="{{ asset('dashboard_assets/node_modules/calendar/fullcalendar.min.js') }}"></script>
	<script src="{{ asset('dashboard_assets/node_modules/calendar/locale-all.js') }}"></script>
	<script src="{{ asset('js/sweetalert.min.js')}}"></script>
	<script src="{{ asset('js/dashboardInvitations.js')}}"></script>

	<!--<script src="{{ asset('dashboard_assets/js/views/my_code_chart.js') }}"></script>-->

	</script>
</body>

</html>
