@extends("../layouts/customApp")

@section("content")
<div class="limiter">
	<div class="container-login100" style="background:#eaeaea">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<img src="{{ asset('LoginTemplate/images/img-01.png') }}" alt="IMG">
			</div>

			<form class="login100-form validate-form" action="{{ route('login') }}" method="POST" id="loginForm">
					{{ csrf_field() }}
				<span class="login100-form-title">
					Se connecter
				</span>

				<div class="wrap-input100 validate-input" data-validate = "Adresse email est obligatoire">
					<input class="input100" type="text" name="email" placeholder="Email" id="emailLog">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-envelope" aria-hidden="true"></i>  --}}
						<i class="kk kk-at"></i>
					</span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Mot de passe est obligatoire">
					<input class="input100" type="password" name="password" placeholder="Password" id="passLog">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-lock" aria-hidden="true"></i>  --}}
						<i class="kk kk-lock"></i>
					</span>
				</div>
				
				<div class="container-login100-form-btn">
					<button class="login100-form-btn" id="login">
						Se connecter
					</button>
				</div>

				<div class="text-center p-t-12">
					<a class="txt2" href="{{ route('reset') }}">
						Mot de passe oubliée?
					</a>
				</div>

				<div class="text-center p-t-136">
					<a class="txt2" href="{{ route('chooseRole') }}" id="select_role">
						Creer votre compte
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="{{ asset('LoginTemplate/js/scriptLogin.js') }}"></script>
@endsection