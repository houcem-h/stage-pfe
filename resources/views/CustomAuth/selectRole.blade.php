@extends("../layouts/customApp")
<!--nav for login-->
@include("../CustomAuth/homenav")


@section("content")
<div class="limiter" style="font-family: Poppins-Bold !important">
	<div class="container-login100" style="background:#eaeaea">
		<div class="wrap-login100 shadowDiv col-sm-9 col-offset-sm-1 hidden-xs" style="height: 400px;padding: 0;">
            <div class="col-md-6"style="background:#00b894;display: flex;justify-content: center;align-items: center;">
               <div>
                    <h1 class="text-center"><i class="kk kk-users"></i></h1>
                   <h1 class="text-center" style="color:white;font-family:Poppins-Regular">Compte Etudiant</h1>
                   <p class="text-center" style="color:white;font-size:15px">Vous êtes un étudiant?<br> Cliquer sur cette boutton pour creer un compte</p>
                    <center><boutton class="btn hvr-shutter-in-horizontal commencer student">Commencer</boutton></center>
                </div>
            </div>
            <div class="col-md-6" style="display: flex;justify-content: center;align-items: center;">
                <div >
                        <h1 class="text-center"><i class="kk kk-camera-bag"></i></h1>
                    <h1 class="text-center" style="font-family:Poppins-Regular">Compte Enseignant</h1>
                    <p class="text-center" >Vous êtes un enseignant?<br> Cliquer sur cette boutton pour creer un compte</p>
                    <center><boutton class="btn hvr-shutter-in-horizontal commencer teacher">Commencer</boutton></center>
                </div>
            </div>
        </div>

        <div class="wrap-login100 col-xs-12 visible-xs" style="height: 400px;padding: 0;">
                <div class="col-xs-12"style="background:#00b894;display: flex;justify-content: center;align-items: center;
                height:50%">
                    <div>
                           
                        <h1 class="text-center" style="color:white;font-family:Poppins-Regular;font-size:20px;"><i class="kk kk-users"></i> Compte Etudiant</h1>
                        <p class="text-center" style="color:white;font-size:15px">Vous êtes un etudiant? Cliquer sur cette boutton pour creer un compte</p>
                        <center><boutton class="btn btn-default commencer student" style="background:lightgrey">Commencer</boutton></center><br><br>
                    </div>
                </div>
                
                <div class="col-xs-12"style="display: flex;justify-content: center;align-items: center;
                height:50%">
                    <div>
                           
                        <h1 class="text-center" style="font-family:Poppins-Regular;font-size:20px;"><i class="kk kk-camera-bag"></i> Compte Enseignant</h1>
                        <p class="text-center">Vous êtes un enseignat? Cliquer sur cette boutton pour creer un compte</p>
                        <center><boutton class="btn btn-default commencer teacher" style="background: lightgrey;">Commencer</boutton></center><br><br>
                    </div>
                </div>
            </div>
	</div>
</div>
@endsection