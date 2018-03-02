<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Dashboard</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="{{asset('studentDashboard/css/bootstrap.css')}}" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="{{asset('studentDashboard/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="{{asset('studentDashboard/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('studentDashboard/css/custom.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('studentDashboard/css/jquery.toast.css') }}">
    <link rel="stylesheet" href="{{ asset('studentDashboard/css/animate.css') }}">
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-inverse set-radius-zero customNavDashboardStudent">
        <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">
                        <li>
                            <a>
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a>
                            <h4 style="color:white">{{ auth()->user()->firstname ." ".auth()->user()->lastname }}</h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a class="menu-top-active" href="{{ route('dashboard_student')}}">Tableau de bord</a></li>
                            <li>
                                @if(Session::has("t"))
                                    <a href="{{ url('student/demande?t='.Session::get('t')) }}">
                                @else
                                    <a href="{{ route('demande_stage') }}">
                                @endif
                                Demande d'un stage</a>
                            </li>
                            <li><a href="{{ route('history') }}">Historique</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                    Parametres
                                </a>
                                <div class="dropdown-menu dropdown-settings" style="width: 200px;">
                                    <div>
                                        <a href="{{ route('edit_profile') }}" style="color:black;font-size:12px">Modifier profile</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('edit_email') }}" style="color:black;font-size:12px">Modifer email</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('edit_password') }}" style="color:black;font-size:12px">Modifer mot de passe</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        style="color:black;font-size:12px">
                                                Déconnecter
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
</section>
<!-- MENU SECTION END-->
@yield("content")











{{--  SCRIPTS  --}}
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{asset('studentDashboard/js/bootstrap.js')}}"></script>
<script src="{{ asset('js/sweetalert.min.js')}}"></script>
<script src="{{ asset('js/script-student.js')}}"></script>
<script src="{{ asset('studentDashboard/js/jquery.toast.js') }}"></script>
<script>
var success;
</script>
</body>
</html
