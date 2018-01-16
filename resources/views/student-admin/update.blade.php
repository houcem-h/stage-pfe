@extends('../layouts/app')
@section("content")
  <div class="container">
    <?php
        session_start();
        session_unset();
        session_destroy();
        // destroy the success session, becoz when user want to go back to the previous page, the success alert will not be showed
    ?>
    @if(Session::has("success_update"))
        <script> var success = true; </script>
    @endif
    <div class="row">
    <div class="form_update_student col-lg-6">
      <div class="text-center">
        <h2>Update student informations</h2>
      </div>
      <form action="{{ route('save_updates', \Request::segment(2))}}" method="POST">
          {{ csrf_field() }}
        <div class="form-group">
            <label>Id student :</label>
            <input type="text" name="id_student" value="{{$student->id}}" class="form-control" disabled id="id_student">
        </div>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="NomS_up_err">
            <label>First name :</label>
            <input type="text" name="name" value="{{ old('name',$student->firstname) }}" class="form-control" id="nom_student">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}" id="LastS_up_err">
            <label>Last name :</label>
            <input type="text" name="last_name" value="{{ old('last_name',$student->lastname) }}" class="form-control" id="last_student">
            @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" id="EmailS_up_err">
            <label>Email :</label>
            <input type="text" name="email" value="{{ old('email',$student->email) }}" class="form-control" id="email_update">
              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
        </div>
        <div class="form-group{{ $errors->has('cin') ? ' has-error' : '' }}" id="CinS_up_err">
            <label>Cin :</label>
            <input type="text" name="cin" value="{{ old('cin',$student->cin) }}" class="form-control" id="cin_student">
            @if ($errors->has('cin'))
                <span class="help-block">
                    <strong>{{ $errors->first('cin') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}" id="dateS_up_err">
            <label>Date of birth :</label>
            <input type="date" name="dob" value="{{ old('birthdate',$student->birthdate) }}" class="form-control" id="date_student">
            @if ($errors->has('dob'))
                <span class="help-block">
                    <strong>{{ $errors->first('dob') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}" id="PhoneS_up_err">
            <label>Phone number :</label>
            <input type="text" name="phone" value="{{ old('phone',$student->phone) }}" class="form-control" id="phone_student">
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
        <small class="text-danger danger">All fields are required</small>
        <div class="form-group">
          <a href="save_updated_student">
            <input type="submit" class="btn btn-primary btn-group-justified" value="Save" id="save_student"></button>
          </a>
        </div>
      </form>
    </div>
    <div class="save_update_studen_group col-lg-5 col-lg-offset-1">
      <div class="text-center">
        <h2>Update student group</h2>
      </div>
        @if($hasGroup == true)
          <form action="" method="POST">
            <div class="form-group Div_Err">
                <label>Group name in session <span id="session">{{ $session}}</span></label>
                <input type="text" name="group_student_edit" value="{{$group_name}}" class="form-control"
                id="group_student_edit">
                <span class="danger span_Err"></span>
            </div>
            <div class="groups">
              <p>Groups that are availble for that stream : </p>
              @foreach($groups_choice as $group)
                <div class="Dispo_group">
                  <span>{{ $group['name']}}</span>
                </div>
              @endforeach
            </div>
            <div style="clear:both"></div>
            <br>
            <small class="text-danger danger">This section is availble before the month of February!!! </small>
              <input type="submit" class="save_update_group_student btn btn-primary btn-group-justified" value="Save">
          </form>
        @else
          <p>This student doesn't register yet </p>
        @endif
    </div>
  </div>
</div>
@endsection
