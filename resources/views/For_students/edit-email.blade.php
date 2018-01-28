@extends('../layouts/dashboard')

@section("content")
  <div class="container">
    <br>
    <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Modifier adresse email</h4>
            </div>
    </div>
    <div class="row">
        <div class="form-edit col-lg-12">
            <div class="edit-email col-lg-6 col-lg-offset-3" style="background-color:white">
                <form action="{{route('send_email')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Addresse email : </label>
                        <input type="text" name="email" value="{{ $email }}" class="form-control" disabled>
                        <span class="text-info">Cliquer sur le bouton ci dessous pour envoyer un email de confirmation</span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-group-justified" value="Envoyer un email" id="save_new_email">
                    </div>
                  </form>
              </div>
            </div>
        </div>
    </div>

  </div>
@endsection
