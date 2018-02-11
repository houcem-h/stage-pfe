@extends("../layouts/customApp")
<!--nav for login-->
@include("../CustomAuth/homenav")
@section("content")
<div class="limiter">
	<div class="container-login100" style="background:#eaeaea">
        <div class="wrap-login100" style="padding: 90px;">
            <div class="login100-pic js-tilt" data-tilt>
				<img src="{{ asset('LoginTemplate/images/like.png') }}" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="" method="post" style="margin-top: -70px;" id="codeForm">
                    
				<span class="login100-form-title">
					Confirmation
                </span>
                <div class="form-group">
                    <label>nous vous avons envoyé un email contenant un code pour confirmer pour nouvelle mot de passe</label>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "code est obligatoire">
					<input class="input100" type="text" name="code" placeholder="Code de confimation" id="code">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						{{--  <i class="fa fa-user" aria-hidden="true"></i>  --}}
						<i class="kk kk-barcode"></i>
					</span>
                </div>


                <div class="container-login100-form-btn">
					<button class="login100-form-btn" id="SaveCodeConfirmation">
						Confirmer
					</button>
				</div>
            </form>
        </div>
    </div>
</div>
@endsection