@extends('layouts.app')

@section('content')

<style media="screen">
input[type=submit] {
  background: #fff0;;
    border: 0;

}

</style>

<div class="col-lg-8 col-md-8 col-lg-offset-2">
    <div class="card">
        <div class="card-header" data-background-color="bleu">
            <h4 class="title">Not done yet </h4>
            <p class="category"></p>
        </div>
        <div class="card-content table-responsive">


          <form action="{{ route('editPasswordteacher') }}" method="POST" id="EditPasswordFormteacher">
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
                  <input type="submit" name="save_new_passteacher" id="save_new_passteacher" class="pull-right btn sendbtn" >
          </form>





          <a style="color:snow" class="btn deletebtn  pull-left"href="{{ URL::previous() }}">Retour</a>

      </div>
  </div>
  </div>
@endsection
