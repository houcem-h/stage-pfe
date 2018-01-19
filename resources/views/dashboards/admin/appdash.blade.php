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

	<!-- Main styles for this application -->
	<link href="{{ asset('dashboard_assets/css/style.css') }}" rel="stylesheet">
	{{--  AMINE BEJAOUI MODIFICATIONS--}}
	<link href="{{ asset('dashboard_assets/css/custom_nav_dashboard.css') }}" rel="stylesheet">
	{{--  END MODIFICATIONS--}}
	<!-- Styles required by this views -->
	<link href="{{ asset('dashboard_assets/node_modules/calendar/fullcalendar.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="http://kouki.website/vendor/koukicons/koukicons.min.css" rel="stylesheet">
  <style>
	  * {
		font-family: 'Raleway', sans-serif;
	  }
  </style>
</head>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
	<header class="app-header navbar">
		<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="#"></a>
		<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
			<span class="navbar-toggler-icon"></span>
		</button>


		<ul class="nav navbar-nav ml-auto" id="custom">
				{{-- Hazem MODIFICATIONS --}}
			<li><a href="{{route('teachers')}}">Teachers  list</a></li>
			<li><a href="{{'teachers/create'}}">Add teacher</a></li>
			
			{{--  AMINE BEJAOUI MODIFICATIONS --}}
			<li><a href="{{route('group')}}">Group list</a></li>
			<li><a href="{{route('show_blade_add')}}">Add group</a></li>
      <li><a href="{{route('show_all_students')}}">List of students</a></li>
			{{--  END MODIFICATIONS --}}
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<img src="{{ asset('dashboard_assets/img/avatars/user.png') }}" class="img-avatar" alt="admin@stage.com">
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<div class="dropdown-header text-center">
						<strong>Settings</strong>
					</div>
					<a class="dropdown-item" href="#">
						<i class="fa fa-user"></i> Profile</a>
					<a class="dropdown-item" href="#">
						<i class="fa fa-wrench"></i> Settings</a>
					<div class="divider"></div>
					<a class="dropdown-item"  href="{{ route('logout') }}"
					onclick="event.preventDefault();
							 document.getElementById('logout-form').submit();">
						<i class="fa fa-lock"></i> Logout </a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
				</div>
			</li>
		</ul>
		&nbsp;&nbsp;


	</header>

	<div class="app-body">
		<div class="sidebar">
			<nav class="sidebar-nav">
				<ul class="nav">
					<br>
					<div class="sidebar-header">
						<img src="http://stage.pfe/dashboard_assets/img/avatars/user.png" width="35%" class="img-avatar" alt="Avatar">

						<div>

							<strong>{{ Auth::user()->firstname }}  {{ Auth::user()->lastname }} </strong>
						</div>
						<div class="text-muted">
							<small><i class="kk kk-badge"></i> Admin</small>
						</div>
						<div class="btn-group" role="group" aria-label="Button group with nested dropdown">

							<div class="btn-group" role="group">

								<div class="dropdown-menu">
									<div class="dropdown-header text-center">
										<strong>Settings</strong>
									</div>
									<a class="dropdown-item" href="#">
										<i class="fa fa-user"></i> Profile</a>
									<a class="dropdown-item" href="#">
										<i class="fa fa-wrench"></i> Settings</a>
									<a class="dropdown-item" href="#">
										<i class="fa fa-usd"></i> Payments
										<span class="badge badge-secondary">42</span>
									</a>
									<a class="dropdown-item" href="#">
										<i class="fa fa-file"></i> Projects
										<span class="badge badge-primary">42</span>
									</a>
									<div class="divider"></div>
									<a class="dropdown-item" href="#">
										<i class="fa fa-shield"></i> Lock Account</a>
									<a class="dropdown-item" href="#">
										<i class="fa fa-lock"></i> Logout</a>
								</div>
							</div>
						</div>
					</div>
					<br>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('dash') }}">
							<i class="kk kk-dashboard"></i> Dashboard </a>
					</li>


					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#">
							<i class="kk kk-users"></i> Manage Users</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="{{ route('Allusers') }}">
									<i class="kk kk-users2"></i>All Users</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('students') }}">
									<i class="kk kk-users2"></i>Students</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('teachers') }}">
									<i class="kk kk-users2"></i>Teacher</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('admins') }}">
									<i class="kk kk-users2"></i>Admins</a>
							</li>
						</ul>
					</li>
					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#">
							<i class="kk kk-event-date2"></i>Defences</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="#">
										<i class="kk kk-event-date2"></i>All Defences</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
										<i class="kk kk-event-date2"></i>Verified Defences</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
										<i class="kk kk-event-date2"></i>Waiting Defences</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
										<i class="kk kk-event-date2"></i>Refused Defences</a>
							</li>

						</ul>
					</li>
					<li class="nav-item nav-dropdown">
							<a class="nav-link nav-dropdown-toggle" href="#">
								<i class="kk kk-department"></i>Interships</a>
							<ul class="nav-dropdown-items">
									<li class="nav-item">
											<a class="nav-link" href="{{ route('interships_all')}}">
												<i class="kk kk-parallel_tasks"></i>All Interships</a>
										</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('interships_init')}}">
										<i class="kk kk-parallel_tasks"></i>Initiation</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('interships_perf')}}">
										<i class="kk kk-parallel_tasks"></i>Perfectionnement</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('interships_pfe')}}">
										<i class="kk kk-parallel_tasks"></i>PFE</a>
								</li>

							</ul>
						</li>
					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="kk kk-overtime"></i> Logs
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="kk kk-piechart"></i> Reports</a>
					</li>

					<li class="divider"></li>
					<li class="nav-title">
						Extras
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="kk kk-settings4"></i> Settings</a>
					</li>
					<!--<li class="nav-item mt-auto">
            <a class="nav-link nav-link-success" href="http://coreui.io/" target="_top"><i class="icon-cloud-download"></i> Download CoreUI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-danger" href="http://coreui.io/pro/" target="_top"><i class="icon-layers"></i> Try CoreUI <strong>PRO</strong></a>
          </li>-->

				</ul>
			</nav>
			<button class="sidebar-minimizer brand-minimizer" type="button"></button>
		</div>

		<!-- Main content -->
		<main class="main">


			<div class="container-fluid">
				<div class="animated fadeIn">
					<!-- Contains START -->
					@yield('dash_content')


					<!-- Contains END -->
				</div>

			</div>
		</main>



	</div>

	<footer class="app-footer">
		<span>
			<a href="#">Stage PFE</a> © 2018 ISET Bizerte.</span>
		<span class="ml-auto">Powered by
			<a href="#">ISET Dev</a>
		</span>
	</footer>

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
	<script src="{{ asset('dashboard_assets/js/views/my_code_chart.js') }}"></script>

	</script>
</body>

</html>
