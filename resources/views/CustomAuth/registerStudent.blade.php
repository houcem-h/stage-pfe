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

			<form class="login100-form validate-form" action="" method="post" style="margin-top: -70px;" id="registerForm">
				<span class="login100-form-title">
					Creer un compte
				</span>

				<div class="wrap-input100 validate-input" data-validate = "Prenom est obligatoire">
					<input class="input100" type="text" name="prenom" placeholder="Prenom" id="prenom">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="kk kk-User"></i>
					</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Nom est obligatoire">
					<input class="input100" type="text" name="nom" placeholder="Nom" id="nom">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="kk kk-User"></i>
					</span>
                </div>


                <div class="wrap-input100 validate-input" data-validate = "Date de naissance est obligatoire">
					<input class="input100" type="date" name="dob" placeholder="Date de naissance" id="dob">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="kk kk-calendar-month"></i>
					</span>
                </div>


                <div class="wrap-input100 validate-input" data-validate = "Adresse email est obligatoire">
					<input class="input100" type="text" name="email" placeholder="Adresse email" id="email">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="kk kk-at"></i>
					</span>
                </div>



				<div class="wrap-input100 validate-input" data-validate = "Cin est obligatoire">
					<input class="input100" type="text" name="cin" placeholder="Cin" id="cin">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="kk  kk-Userlist"></i>
					</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Numero telephone est obligatoire">
					<input class="input100" type="text" name="tel" placeholder="Telephone" id="tel">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="kk kk-Phone"></i>
					</span>
                </div>


                <div class="wrap-input100 validate-input">
					<select class="input100" name="group" id="classe" data-validate = "">
						<option value="default">Choissir votre classe</option>
						@foreach($groups as $group)
							<option value="{{ $group->id }}">{{ $group->name }}</option>
						@endforeach
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
					<p style="margin-top:10px">
						Vous avez un compte? <a href="{{ route('connecter')}}">Se connecter</a>
					</p>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
