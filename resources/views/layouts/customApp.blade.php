<!DOCTYPE html>
<html lang="en">
<head>
	<title>Connecter</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('LoginTemplate/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/css/main.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/css/custom.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/css/koukicons.min.css') }}">
	<!--===============================================================================================-->	
	<script src="{{ asset('LoginTemplate/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
</head>
<body>
	
	@yield("content")
	
	

	

<!--===============================================================================================-->
	<script src="{{ asset('LoginTemplate/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('LoginTemplate/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('LoginTemplate/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('LoginTemplate/vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('LoginTemplate/js/main.js') }}"></script> <!--student -->
<!--===============================================================================================-->
<script src="{{ asset('js/sweetalert.min.js')}}"></script>
<script src="{{ asset('LoginTemplate/js/redirectToRole.js') }}"></script>
<script src="{{ asset('LoginTemplate/js/RegisterTeacher.js') }}"></script> <!-- teacher -->
<script src="{{ asset('LoginTemplate/js/scriptResetPassword.js') }}"></script> <!-- reset -->
<script src="{{ asset('LoginTemplate/js/scriptCodeReset.js') }}"></script> <!-- code_confirm -->

</body>
</html>