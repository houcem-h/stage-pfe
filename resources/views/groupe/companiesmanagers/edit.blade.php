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
        @if(isset($companyManager))
        {!!Form::open(['name'=>$companyManager->id,'method'=>"POST","action"=>["CompaniesManagersController@update",$companyManager->id],'id'=>"formupdatecompanymanager"])!!}
         <h3 class="text-center" style="color:black;"><b>Manager Informations</b></h3><br><hr><br>
        <div class="form-group">
            {{Form::label('name','Manager Name')}}
            {{Form::text('name',$companyManager->name,['class'=>"form-control","id"=>"name"])}}
        </div>

        <div class="form-group">
            {{Form::label('phone','Manager Phone')}}
            {{Form::number('phone',$companyManager->PhoneNumber,['class'=>"form-control",'id'=>"phone"])}}
        </div>
        
        <div class="form-group">
            {{Form::label('email','Manager Email')}}
            {{Form::email('email',$companyManager->email,['id'=>"email",'class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::label('position','Manager Position')}}
            {{Form::text('position',$companyManager->position,['id'=>'position','class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Save',['class'=>"btn btn-default"])}}
        </div>
        {!!Form::close()!!}
        @endif
            <div style="display:none;" id="errorsajax" class="col-md-6 col-md-offset-3">
            </div>

            <div style="display:none;" id="successajax" class="col-md-6 col-md-offset-3">
            </div>
   </div>
  </div>
</div>
    <script type="text/javascript" src="{{ asset('js/mainajax.js') }}"></script>
@endsection