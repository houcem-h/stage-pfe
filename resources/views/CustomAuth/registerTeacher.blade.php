@extends("../layouts/customApp")
<!--nav for login-->
@include("../CustomAuth/homenav")
@section("content")
<div class="limiter">
	<div class="container-login100" style="background:#eaeaea">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<img src="{{ asset('LoginTemplate/images/img-01.png') }}" alt="IMG">
			</div>

			<form class="login100-form validate-form" action="" method="post" style="margin-top: -70px;" id="registerFormTeacher">
				{{ csrf_field()}}
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
                

                <div class="wrap-input100 validate-input" data-validate = "Adresse email est obligatoire">
					<input class="input100" type="text" name="email" placeholder="Adresse email" id="email">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-at" aria-hidden="true"></i>  --}}
						<i class="kk kk-at"></i>
					</span>
                </div>
                

                <div class="wrap-input100 validate-input" data-validate = "Mot de passe est obligatoire">
					<input class="input100" type="password" name="password" placeholder="Mot de passe" id="pass">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-lock" aria-hidden="true"></i>  --}}
						<i class="kk kk-lock2"></i>
					</span>
				</div>
				
				<div class="wrap-input100 validate-input" data-validate = "Confirmation de mot de passe  est obligatoire">
					<input class="input100" type="password" name="password_confirmation" placeholder="confirmer mot de passe" id="passconfirm">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-lock" aria-hidden="true"></i>  --}}
						<i class="kk kk-lock2"></i>
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
                
                <input type="hidden" value="1" id="role">


				<div class="container-login100-form-btn">
					<button class="login100-form-btn" id="creerCompte">
						Creer un compte
					</button>
					<p style="margin-top:10px">
						Vous avez un compte? <a href="{{ route('connecter')}}">Se connecter</a>
					</p>
				</div>

			</form>
		</div>
	</div>
</div>
@endsection 