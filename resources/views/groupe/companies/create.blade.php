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
    {{session('success')}}
@endif
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <a class="btn btn-default" style="margin-bottom:50px;" href="{{auth()->user()->Dashboard}}">Go Back</a>
            <div id="animationloadingbarcontainer">
                <div  id="bar"></div>
            </div>
        {!!Form::open(['method'=>"POST","action"=>"CompaniesController@store",'id'=>"formcreatecompany"])!!}
        <h3 class="text-center" style="color:black;"><b>Informations Societe</b></h3><br><hr><br>
        <div class="form-group">
            {{Form::label('name','Company Name')}}
            {{Form::text('name','',['class'=>"form-control","id"=>"name"])}}
        </div>

        <div class="form-group">
            {{Form::label('activity','Company Activity')}}
            {{Form::text('activity','',['id'=>"activity",'class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::label('phone','Company Phone')}}
            {{Form::number('phone','',['class'=>"form-control",'id'=>"phone"])}}
        </div>

        <div class="form-group">
            {{Form::label('fax','Company Fax')}}
            {{Form::number('fax','',['id'=>'fax','class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::label('address','Company Adress')}}
            {{Form::text('address','',['id'=>"address","class"=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::submit('Save',['class'=>"btn btn-default"])}}
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