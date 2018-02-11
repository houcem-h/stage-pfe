@extends("../layouts/customApp")
<!--nav for login-->
@include("../CustomAuth/homenav")
@section("content")
<div class="limiter">
	<div class="container-login100" style="background:#eaeaea">
		<div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt style="margin-top: -50px;">
				<img src="{{ asset('LoginTemplate/images/lock2.png') }}" alt="IMG">
            </div>
            <form action="{{ route('sendCodeReset') }}" method="POST" id="ResetPasswordForm" class="login100-form validate-form"
            style="margin-top: -70px;">
                {{ csrf_field() }}
				<span class="login100-form-title">
					réinitialiser le mot de passe
                </span>
                
                <div class="wrap-input100 validate-input" data-validate = "Adresse email est obligatoire">
					<input class="input100" type="text" name="email" placeholder="Email" id="emailReset">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
                        {{--  <i class="fa fa-envelope" aria-hidden="true"></i>  --}}
                        <i class="kk kk-at"></i>
					</span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate = "Mot de passe email est obligatoire">
					<input class="input100" type="password" name="password" placeholder="Nouvelle mot de passe" id="passwordReset">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
                        {{--  <i class="fa fa-envelope" aria-hidden="true"></i>  --}}
                        <i class="kk kk-lock"></i>
					</span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate = "Confirmation mot de passe email est obligatoire">
					<input class="input100" type="password" name="password_confirmation" placeholder="Confirmer mot de passe" id="passwordConfirmReset">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
                        {{--  <i class="fa fa-envelope" aria-hidden="true"></i>  --}}
                        <i class="kk kk-lock"></i>
					</span>
                </div>
                

                <div class="container-login100-form-btn">
					<button class="login100-form-btn" id="resetMe">
						réinitialiser
					</button>
				</div>

            </form>
        </div>

	</div>
</div>
@endsection