@extends("../layouts/customApp")

@section("content")
<div class="limiter">
	<div class="container-loader">
		<div class="sk-rotating-plane"></div>
	</div>

	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<img src="{{ asset('LoginTemplate/images/img-01.png') }}" alt="IMG">
			</div>

			<form class="login100-form validate-form" action="" method="post" style="margin-top: -70px;" id="registerForm">
				<span class="login100-form-title">
					Creer un compte
				</span>

				<div class="wrap-input100 validate-input" data-validate = "Prenom est obligatoire">
					<input class="input100" type="text" name="prenom" placeholder="Prenom" id="prenom">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-user" aria-hidden="true"></i>  --}}
						<i class="kk kk-User"></i>
					</span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate = "Nom est obligatoire">
					<input class="input100" type="text" name="nom" placeholder="Nom" id="nom">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-user" aria-hidden="true"></i>  --}}
						<i class="kk kk-User"></i>
					</span>
                </div>
                

                <div class="wrap-input100 validate-input" data-validate = "Date de naissance est obligatoire">
					<input class="input100" type="date" name="dob" placeholder="Date de naissance" id="dob">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-calendar" aria-hidden="true"></i>  --}}
						<i class="kk kk-calendar-month"></i>
					</span>
                </div>


                <div class="wrap-input100 validate-input" data-validate = "Adresse email est obligatoire">
					<input class="input100" type="text" name="email" placeholder="Adresse email" id="email">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-at" aria-hidden="true"></i>  --}}
						<i class="kk kk-at"></i>
					</span>
                </div>
                

                <!--<div class="wrap-input100 validate-input" data-validate = "Mot de passe est obligatoire">
					<input class="input100" type="password" name="pass" placeholder="Mot de passe" id="pass">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-lock" aria-hidden="true"></i>  --}}
						<i class="kk kk-lock2"></i>
					</span>
                </div> -->

				<div class="wrap-input100 validate-input" data-validate = "Cin est obligatoire">
					<input class="input100" type="text" name="cin" placeholder="Cin" id="cin">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-address-card-o" aria-hidden="true"></i>  --}}
						<i class="kk  kk-Userlist"></i>
					</span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate = "Numero telephone est obligatoire">
					<input class="input100" type="text" name="tel" placeholder="Telephone" id="tel">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-phone" aria-hidden="true"></i>  --}}
						<i class="kk kk-Phone"></i>
					</span>
                </div>
                

                <div class="wrap-input100 validate-input">
					<select class="input100" name="group" id="classe">
						
					</select>
					<span class="symbol-input100">
						<i class="kk kk-camera-bag "></i>
					</span>



				</div>
				







                <input type="hidden" value="0" id="role">


				<div class="container-login100-form-btn">
					<button class="login100-form-btn" id="creerCompte">
						Creer un compte
					</button>
				</div>

				{{--  <div class="text-center p-t-12">
					<span class="txt1">
						Forgot
					</span>
					<a class="txt2" href="#">
						Username / Password?
					</a>
				</div>  --}}

				{{--  <div class="text-center p-t-136">
					<a class="txt2" href="#">
						Create your Account
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
					</a>
				</div>  --}}
			</form>
		</div>
	</div>
</div>
@endsection 