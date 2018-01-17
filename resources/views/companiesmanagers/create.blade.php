@extends('layouts.app')
@section('content')
<div class="container">
@forelse($errors->all() as $er)
    {{$er}}
@empty
@endforelse

@if(session('error'))
    {{session('error')}}
@endif

@if(session('success'))
    <h1>{{session('success')}}</h1>
@endif
          

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <a class="btn btn-default" style="margin-bottom:50px;" href="{{URL::previous()}}}">Precedent</a>
        <div id="animationloadingbarcontainer">
            <div  id="bar"></div>
        </div>
 @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        {!!Form::open(['method'=>"POST","action"=>"CompaniesManagersController@store",'id'=>"formcreatecompanymanager"])!!}
         <h3 class="text-center" style="color:black;"><b>Informations Encadreur Societe</b></h3><br><hr><br>
        <div class="form-group">
            {{Form::label('name','Nom & prenom')}}
            {{Form::text('name','',['class'=>"form-control","id"=>"name"])}}
        </div>

        <div class="form-group">
            {{Form::label('phone','Telephone')}}
            {{Form::number('phone','',['class'=>"form-control",'id'=>"phone"])}}
        </div>
        
        <div class="form-group">
            {{Form::label('email','Email')}}
            {{Form::email('email','',['id'=>"email",'class'=>"form-control"])}}
        </div>

        <input name="company" type="hidden" value=
         @if(Session::has("ci"))
           {{Session::get('ci')}}
         @endif
        >
        <div class="form-group">
            {{Form::label('position','Position(role dans la societe)')}}
            {{Form::text('position','',['id'=>'position','class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::submit('Confirmer',['class'=>"btn btn-default"])}}
        </div>

        {!!Form::close()!!}
            <div style="display:none;" id="errorsajax" class="col-md-6 col-md-offset-3">
            </div>

            <div style="display:none;" id="successajax" class="col-md-6 col-md-offset-3">
            </div>
   </div>
  </div>
</div>
    <script type="text/javascript" src="{{ asset('js/mainajax.js') }}"></script>
@endsection