@extends("../layouts/customApp")

@section("content")
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100 col-md-12 hidden-xs" style="height: 400px;padding: 0;">
            <div class="student col-md-6"style="background:#fdcb6e;display: flex;justify-content: center;align-items: center;">
                <h1 style="color:white">Compte etudiant</h1>
            </div>
            <div class="teacher col-md-6" style="display: flex;justify-content: center;align-items: center;">
                <h1>Compte enseignant</h1>
            </div>
        </div>

        <div class="wrap-login100 col-md-12 visible-xs" style="height: 400px;padding: 0;">
                <div class="student col-xs-12"style="background:#fdcb6e;display: flex;justify-content: center;align-items: center;
                height:50%">
                    <h2 style="color:white">Compte etudiant</h2>
                </div>
                
                <div class="teacher col-xs-12"style="display: flex;justify-content: center;align-items: center;
                height:50%">
                    <h2>Compte enseignant</h2>
                </div>
            </div>
	</div>
</div>
@endsection