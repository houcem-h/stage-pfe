@extends('../layouts/dashboard')

@section("content")
<div class="container">
    <br>
    <div class="row">
          <div class="col-md-12">
              <h4 class="page-head-line">Email a été envoyé avec succés</h4>
          </div>
    </div>
      <div class="row">
          <div class="message col-lg-6 col-lg-offset-3" style="background:white">
            <div class="panel panel-default">
                <div class="panel-body">
                  <p>Nous vous avons envoyé un mail pour confirmer votre changement.</p>
                  <p>Veuillez vérifier votre boite de recepetion pour continuer...!</p>
                </div>
            </div>
          </div>
      </div>
  </div>
@endsection
