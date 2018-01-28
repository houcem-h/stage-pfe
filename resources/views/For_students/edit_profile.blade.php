@extends('../layouts/dashboard')

@section("content")
  @if(Session::has("success-update"))
      <script> success = true; </script>
  @endif
  <div class="container">
      <br>
      <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Modifier informations</h4>
            </div>
      </div>
      <div class="row">
          <div class="form-edit col-lg-6 col-lg-offset-3">
            <form action="{{route('student_save_info')}}" method="POST">
              {{ csrf_field() }}
                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                    <label>Nom : </label>
                    <input type="text" value="{{old('firstname',$informations->firstname)}}" name="firstname" class="form-control">
                    @if ($errors->has('firstname'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <label>Prenom : </label>
                    <input type="text" value="{{old('lastname',$informations->lastname)}}" name="lastname" class="form-control">
                    @if ($errors->has('lastname'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('date_naissance') ? ' has-error' : '' }}">
                    <label>Date de naissance : </label>
                    <input type="date" value="{{old('date_naissance',$informations->birthdate)}}" name="date_naissance" class="form-control">
                    @if ($errors->has('date_naissance'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('date_naissance') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('cin') ? ' has-error' : '' }}">
                    <label>Cin : </label>
                    <input type="text" value="{{old('cin',$informations->cin)}}" name="cin" class="form-control">
                    @if ($errors->has('cin'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('cin') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label>Phone : </label>
                    <input type="text" value="{{old('phone',$informations->phone)}}" name="phone" class="form-control">
                    @if ($errors->has('phone'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <span class="text-danger">All fields are required</span>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-group-justified" id="student-save-profile" value="Save changes">
                </div>
            </form>
          </div>
      </div>
  </div>
@endsection
