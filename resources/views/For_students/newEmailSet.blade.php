@extends('../layouts/dashboard')

@section("content")
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">
                Enter nouvelle adresse email
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="form-edit col-lg-12">
            <div class="edit-email col-lg-6 col-lg-offset-3" style="background-color:white">
                <form action="{{ route('submit_newEmail') }}" method="post" id="SetNewEmailForm">
                    {{ csrf_field() }}
                    <div class="form-group Div_Err_Email">
                        <label>Nouvelle adresse email : </label>
                        <input type="text" name="email" value="" class="form-control" id="email">
                        <span class="text-danger Span_Err_Email"></span>
                    </div>
                    <div class="form-group Div_Err_Pass">
                        <label>Votre mot de passe</label>
                        <input type="password" name="password" value="" class="form-control" id="password">
                        <span class="text-danger Span_Err_Pass"></span>
                    </div>
                    <div class="form-group Div_Err_PassC">
                        <label>Confirmer mot de passe</label>
                        <input type="password" name="password_confirmation" value="" class="form-control" id="password_confirmation">
                        <span class="text-danger Span_Err_PassC"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-group-justified" value="Save changes" id="saveEmail">
                    </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
  </div>
@endsection
