@extends('layouts.dashboard')
@section('content')
<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
       
        <div id="animationloadingbarcontainer">
            <div  id="bar"></div>
        </div>
        {!!Form::open(['name'=>$companyManager->id,'method'=>"POST","action"=>["CompaniesManagersController@update",$companyManager->id],'id'=>"formupdatecompanymanager"])!!}
                 <h3 class="text-center" style="color:black;"><b>Informations Encadreur Societe</b></h3><br><hr><br>

        <div class="form-group">
            {{Form::label('name','Nom')}}
            {{Form::text('name',$companyManager->name,['class'=>"form-control","id"=>"name"])}}
        </div>

        <div class="form-group">
            {{Form::label('phone','Telephone')}}
            {{Form::number('phone',$companyManager->PhoneNumber,['class'=>"form-control",'id'=>"phone"])}}
        </div>
        
        <div class="form-group">
            {{Form::label('email','Email')}}
            {{Form::email('email',$companyManager->email,['id'=>"email",'class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::label('position','Position(role dans la societe)')}}
            {{Form::text('position',$companyManager->position,['id'=>'position','class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::hidden('_method','PUT')}}
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

@endsection