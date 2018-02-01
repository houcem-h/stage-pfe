@extends('../layouts/app')

@section("content")
<?php
        session_start();
        session_unset();
        session_destroy();
        // destroy the success session, becoz when user want to go back to the previous page, the success alert will not be showed
    ?>
@if(Session::has("successAddStudent"))
    <script> var successAddStudent = true; </script>
@endif
    <div class="container">
        <div class="form col-md-6 col-xs-12 col-md-offset-3" id="addStudentForm">
            <div class="text-center">
                <h3>Ajouter un etudiant</h3>
            </div>
            <form action="{{ route('save_added_student') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                    <label>Nom :</label>
                    <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}">
                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <label>Prenom :</label>
                    <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}">
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>Adresse email :</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                    <label>Date de naissance :</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                    @if ($errors->has('dob'))
                        <span class="help-block">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('cin') ? ' has-error' : '' }}">
                    <label>Cin :</label>
                    <input type="text" name="cin" class="form-control" value="{{ old('cin') }}">
                    @if ($errors->has('cin'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cin') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label>Telephone :</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Classe</label>
                    <select class="form-control" name="group_name">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-group-justified" value="Ajouter" id="addStudent">
                </div>
            </form>
        </div>
    </div>
@endsection