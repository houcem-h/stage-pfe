<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Stage PFE') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('LoginTemplate/css/koukicons.min.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.5/css/mdb.min.css" rel="stylesheet" type="text/css">
        
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>


        
        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <div class="title m-b-md">
                    <i class="kk kk-graduation_cap"></i> Stage &amp; PFE
                </div>
             

                <div class="links">
                        @if (Route::has('login'))
                        
                            @auth
                                <a class="btn btn-lg btn-outline-info waves-effect" href="{{ url('/home') }}"><i class="kk kk-home"></i>&nbsp;&nbsp; Accueil</a>
                            @else
                                <a class="btn btn-lg btn-outline-danger waves-effect" href="{{ route('connecter') }}"><i class="kk kk-key-x"></i>&nbsp;&nbsp;Connexion</a>
                                <a class="btn btn-lg btn-outline-success waves-effect" href="{{ route('chooseRole') }}"><i class="kk kk-Plus-Fill"></i>&nbsp;&nbsp;Inscription</a>
                            @endauth
                        
                    @endif
                </div>

              
                <br>
                <div class="links">
                        <a href="http://www.isetb.rnu.tn/" class="btn btn-outline-secondary btn-rounded waves-effect"><i class="kk kk-internet"></i>&nbsp;&nbsp;Site ISET Bizerte</a>
                        <a class="btn btn-outline-primary btn-rounded waves-effect" href="https://www.facebook.com/D%C3%A9partement-Technologies-de-lInformatique-ISET-de-Bizerte-292264790839063/"><i class="kk kk-facebook"></i>&nbsp;&nbsp;Page Facebook ISET Bizerte</a>
                        <a class="btn btn-outline-primary btn-rounded waves-effect" href="https://www.facebook.com/D%C3%A9partement-Technologies-de-lInformatique-ISET-de-Bizerte-292264790839063/"><i class="kk kk-facebook"></i>&nbsp;&nbsp;Page Facebook ISET Bizerte Département TI</a>
                </div>




            </div>
        </div>
    </body>
</html>
