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
	@yield('assets')
</head>


<style>
	/* Remove dark-nav class from nav tag to see the light version  */
* {
	padding: 0;
	margin: 0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	outline: none;
	font-family: arial;
  }
  
  .container:after, .container:before {
	content: "";
	display: block;
	clear: both;
  }
  
  /* Start navbar */
  .nav {
	background-color: #f8f8f8;
	border-bottom: 1px solid #ececec;
	min-height: 50px;
	height: auto;
  }
  .nav .nav-heading {float: left}
  
  .nav .nav-heading .toggle-nav {
	padding: 2px 10px;
	border-radius: 5px;
	border: none;
	display: none;
	background-color: transparent;
  }
  .nav .nav-heading > a {
	text-decoration: none;
	color: #000;
	line-height: 60px;
	font-weight: 400;
	font-size: 19px;
  }
  
  /* Start menu */
  .nav .menu {
	float: right;
  }
  .nav .menu:after {
	content: "";
	clear: both;
	display: block;
  }
  .nav .list {
	float: right;
	margin: 0;
  }
  .nav .list > li {
	float: left;
	list-style: none;
  }
  .nav .list > li > a {
	color: #555;
	text-decoration: none;
	display: block;
	line-height: 60px;
	padding: 0 10px;
  }
  .nav .list > li > a:hover,
  .nav .list > li.active > a {
	color: #333
  }
  
  /* Start drodpwn menu */
  .categories {
	position: relative;
  }
  .nav .list .categories .drop-down {
	list-style: none;
	position: absolute;
	top: 100%;
	left: 0;
	background-color: #FFF;
	border: 1px solid #ccc;
	padding: 5px 0;
	min-width: 160px;
	width: auto;
	white-space: nowrap;
	-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
	box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
	display: none;
	z-index: 99999
  }
  .nav .list .drop-down > .seprator {
	height: 1px;
	width: 100%;
	margin: 9px 0;
	background-color: #e5e5e5
  }
  .drop-down > li > a {
	color: #333;
	display: block;
	padding: 3px 20px;
	text-decoration: none;
  }
  .show {
	display: block
  }
  
  /* Sub dropdown menu */
  .categories .drop-down .sub-drop-down {position: relative}
  .categories .drop-down .sub-drop-down:hover .sub-dropdown {
	display: block;
  }
  .categories .drop-down .sub-dropdown {
	position: absolute;
	top: -20px;
	left: 107%;
	list-style: none;
	background-color: #ffffff;
	border: 1px solid #cccccc;
	border-radius: 3px;
	padding: 10px;
	-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
	box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
	display: none;
  }
  .categories .drop-down .sub-dropdown:before {
	content: "";
	display: block;
	position: absolute;
	top: 20px;
	left: -20px;
	border-top: 10px solid transparent;
	border-left: 10px solid transparent;
	border-bottom: 10px solid transparent;
	border-right: 10px solid #cccccc
  }
  .categories .drop-down .sub-dropdown > li > a {
	color: #555;
	padding: 5px 0;
	display: block
  }
  /* End sub dropdown menu */
  /* Dark theme */
  .dark-nav {background-color: #2f3340}
  
  .dark-nav .list > li > a {color: #BBB}
  
  .dark-nav .list > li > a:hover,
  .dark-nav .list > li.active > a {color: #FFF}
  
  .dark-nav .nav-heading > a {color: #EEE}
  
  .dark-nav .nav-heading .toggle-nav {color: #EEE}
  
  /* End Dark theme */
  
  /* Start media query for navbar */
  @media (max-width: 767px) {
	.nav .container {
	  padding-right: 0;
	  padding-left: 0;
	}
	.nav .nav-heading {
	  width: 100%;
	  padding-left: 15px;
	  padding-right: 15px;
	  border-bottom: 1px solid #e7e7e7
	}
	.nav .nav-heading .brand {float: left}
  
	.nav .nav-heading .toggle-nav {
	  display: block;
	  float: right;
	  margin-top: 14px;
	}
  
	.nav .menu {
	  width: 100%;
	  padding-left: 15px;
	  padding-right: 15px;
	  display: none;
	}
  
	.nav .list {
	  float: none;
	  width: 100%;
	}
	.nav .list > li {
	  float: none;
	  width: 100%;
	}
	.nav .list > li > a {padding: 12px 0;line-height: 1}
  
	.nav .list .categories .drop-down {
	  background-color: transparent;
	  border: none;
	  position: static;
	  -webkit-box-shadow: none;
	  box-shadow: none;
	  padding: 0
	}
	.categories .drop-down .sub-dropdown {
	  position: static;
	  background-color: transparent;
	  border: none;
	  -webkit-box-shadow: none;
	  box-shadow: none;
	  padding-left: 20px;
	}
	.categories .drop-down .sub-dropdown > li > a {
	  color: #888;
	}
	.categories .drop-down .sub-dropdown:before {
	  display: none
	}
	/* Simple reset for dark theme */
	.dark-nav .menu {background-color: #252831}
	.dark-nav .nav-heading {border-bottom-color: #31343c}
	.dark-nav .list .drop-down > li > a {color: #AAA}
	.dark-nav .list .categories .drop-down .seprator {background-color: #2a2d38}
  
  }
  
</style>


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

<!-- navbar toggle script-->
	<script>
			$(function () {
				'use strict';
				// Start navbar 
				(function () {
				  // Add class active when the user clicks the lis of the menu
				  $('.nav .list li').on('click', 'a', function () {
					$(this).parent().addClass('active').siblings().removeClass('active');
				  });
				  var openCategories = $('.nav #open-categories'),
					  categories = $('.drop-down');
				  // Toggle categories on clicking
				  openCategories.on('click', function () {
					$("#" + $(this).data('dropdown')).toggleClass('show');
					// When the user clicks the window if the categories is not the target, close it.
					$(window).on('mouseup', function (e) {
					  if (categories.hasClass('show') && !categories.is(e.target) && categories.has(e.target).length === 0 && !openCategories.is(e.target)) {console.log("d");
						categories.removeClass('show');
					  }
					});
				  });
				  // Toggle menu, This will be shown in Extra small screens only
				  $('.nav .toggle-nav').on('click', function () {
					$("#" + $(this).data('toggle')).slideToggle(300);
				  });
				}());
			  });
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