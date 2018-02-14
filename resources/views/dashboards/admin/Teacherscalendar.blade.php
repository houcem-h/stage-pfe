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
	<link href="{{ asset('dashboard_assets/css/style.css') }}" rel="stylesheet">
	{{--  AMINE BEJAOUI MODIFICATIONS--}}
	<link href="{{ asset('dashboard_assets/css/custom_nav_dashboard.css') }}" rel="stylesheet">
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


<body class="">
	<script>


	    $(document).ready(function() {

	      $('#calendar').fullCalendar({
	        header: {
	          left: 'prev,next today',
	          center: 'title',
	          right: 'listDay,listWeek,month'
	        },

	        // customize the button names,
	        // otherwise they'd all just say "list"
	        views: {
	          listDay: { buttonText: 'list day' },
	          listWeek: { buttonText: 'list week' }
	        },

	        defaultView: 'listWeek',
	        defaultDate: '2018-01-12',
	        navLinks: true, // can click day/week names to navigate views
	        editable: true,
	        eventLimit: true, // allow "more" link when too many events
	        events: [
	          {
	            title: 'All Day Event',
	            start: '2018-01-01'
	          },
	          {
	            title: 'Long Event',
	            start: '2018-01-07',
	            end: '2018-01-10'
	          },
	          {
	            id: 999,
	            title: 'Repeating Event',
	            start: '2018-01-09T16:00:00'
	          },
	          {
	            id: 999,
	            title: 'Repeating Event',
	            start: '2018-01-16T16:00:00'
	          },
	          {
	            title: 'Conference',
	            start: '2018-01-11',
	            end: '2018-01-13'
	          },
	          {
	            title: 'Meeting',
	            start: '2018-01-12T10:30:00',
	            end: '2018-01-12T12:30:00'
	          },
	          {
	            title: 'Lunch',
	            start: '2018-01-12T12:00:00'
	          },
	          {
	            title: 'Meeting',
	            start: '2018-01-12T14:30:00'
	          },
	          {
	            title: 'Happy Hour',
	            start: '2018-01-12T17:30:00'
	          },
	          {
	            title: 'Dinner',
	            start: '2018-01-12T20:00:00'
	          },
	          {
	            title: 'Birthday Party',
	            start: '2018-01-13T07:00:00'
	          },
	          {
	            title: 'Click for Google',
	            url: 'http://google.com/',
	            start: '2018-01-28'
	          }
	        ]
	      });

	    });

	      </script>

	<div id='calendar'></div>

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
	<script src="{{ asset('js/sweetalert.min.js')}}"></script>
	<script src="{{ asset('js/dashboardInvitations.js')}}"></script>

	<!--<script src="{{ asset('dashboard_assets/js/views/my_code_chart.js') }}"></script>-->

	</script>
</body>

</html>
