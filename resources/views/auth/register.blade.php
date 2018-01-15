@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}


                        <!-- First Name -->
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">Type</label>
    
                                <div class="col-md-6">
                                        <div class="radio">
                                                <label><input type="radio" name="role" value="0" checked>Student</label>&nbsp;
                                                <label><input type="radio" name="role" value="1">Teacher</label>&nbsp;
                                                <label><input type="radio" name="role" value="2">Admin</label>&nbsp;
                                        </div>
                                        
                                </div>
                        </div>




                        <!-- First Name -->
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Last Name -->
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Email Adresse  -->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <!-- Birthdate -->
                        <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                <label for="birthdate" class="col-md-4 control-label">Birthdate</label>
                                <div class="col-md-6">
                                        <input class="form-control" name="birthdate" type="text" id="datepicker" value="{{ old('birthdate') }}">
                                </div>
                            </div>
                        <!-- CIN -->

                        <div class="form-group{{ $errors->has('cin') ? ' has-error' : '' }}">
                                <label for="cin" class="col-md-4 control-label">CIN</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="cin" value="{{ old('cin') }}" required autofocus>
    
                                    @if ($errors->has('cin'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Phone</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>
    
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <!-- Password  -->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Confirm Pass  -->
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <!-- submit  -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
