@extends('../layouts/dashboard')

@section("content")
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">
                Modifier mot de passe
            </h4>
        </div>
    </div>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action="{{ route('editPassword') }}" method="POST" id="EditPasswordForm">
                    <div class="form-group Div_Err_PA">
                        <label>Mot de passe actuel:</label>
                        <input type="password" name="passAct" class="form-control" id="passAct">
                        <span class="text-danger Span_Err_PA"></span>
                    </div>
                    <div class="form-group Div_Err_PN">
                        <label>Nouvelle mot de passe:</label>
                        <input type="password" name="passNouv" class="form-control" id="passNouv">
                        <span class="text-danger Span_Err_PN"></span>
                    </div>
                    <div class="form-group Div_Err_PC">
                        <label>Confirmer mot de passe:</label>
                        <input type="password" name="passNouvConfirm" class="form-control" id="passNouvConfirm">
                        <span class="text-danger Span_Err_PC"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="save_new_pass" id="save_new_pass" class="btn btn-primary btn-group-justified">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

