@extends("../layouts/customApp")

@section("content")
<div class="limiter">
	<div class="container-login100" style="background:#eaeaea">
		<div class="wrap-login100 shadowDiv col-sm-9 col-offset-sm-1 hidden-xs" style="height: 400px;padding: 0;">
            <div class="col-md-6"style="background:#00b894;display: flex;justify-content: center;align-items: center;">
               <div>
                   <h1 class="text-center" style="color:white">Compte etudiant</h1>
                   <p class="text-center" style="color:white;font-size:15px">Vous etes un etudiant! Cliquer sur cette boutton pour creer un compte</p>
                    <center><boutton class="btn hvr-shutter-in-horizontal commencer student">Commencer</boutton></center>
                </div>
            </div>
            <div class="col-md-6" style="display: flex;justify-content: center;align-items: center;">
                <div >
                    <h1 class="text-center">Compte enseignant</h1>
                    <p class="text-center" >Vous etes un enseignant! Cliquer sur cette boutton pour creer un compte</p>
                    <center><boutton class="btn hvr-shutter-in-horizontal commencer teacher">Commencer</boutton></center>
                </div>
            </div>
        </div>

        <div class="wrap-login100 col-xs-12 visible-xs" style="height: 400px;padding: 0;">
                <div class="col-xs-12"style="background:#00b894;display: flex;justify-content: center;align-items: center;
                height:50%">
                    <div>
                        <h1 class="text-center" style="color:white">Compte etudiant</h1>
                        <p class="text-center" style="color:white;font-size:15px">Vous etes un etudiant! Cliquer sur cette boutton pour creer un compte</p>
                        <center><boutton class="btn btn-default commencer student" style="background:lightgrey">Commencer</boutton></center><br><br>
                    </div>
                </div>
                
                <div class="col-xs-12"style="display: flex;justify-content: center;align-items: center;
                height:50%">
                    <div>
                        <h1 class="text-center">Compte enseignant</h1>
                        <p class="text-center">Vous etes un enseignat! Cliquer sur cette boutton pour creer un compte</p>
                        <center><boutton class="btn btn-default commencer teacher" style="background: lightgrey;">Commencer</boutton></center><br><br>
                    </div>
                </div>
            </div>
	</div>
</div>
@endsection