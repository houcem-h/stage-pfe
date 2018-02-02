@extends('layouts.dashboard')
@section('content')
<div class="container">
  <div class="col-md-6 col-md-offset-3">
    
            <div id="animationloadingbarcontainer">
                <div  id="bar"></div>
            </div>  
      {!!Form::open(['method'=>'POST','name'=>$company->id,'id'=>"formupdatecompany",'action'=>['CompaniesController@update',$company->id]])!!}
              <h3 class="text-center" style="color:black;"><b>Informations Societe</b></h3><br><hr><br>  
      <div class="form-group">
            {{Form::label('name','Nom')}}
            {{Form::text('name',$company->name,['class'=>"form-control","id"=>"name"])}}
        </div>

        <div class="form-group">
            {{Form::label('activity','Activité')}}
            {{Form::text('activity',$company->activity,['id'=>"activity",'class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::label('phone','Téléphone')}}
            {{Form::number('phone',$company->PhoneNumber,['class'=>"form-control",'id'=>"phone"])}}
        </div>

        <div class="form-group">
            {{Form::label('fax','Fax')}}
            {{Form::number('fax',$company->FaxNumber,['id'=>'fax','class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::label('address','Adresse')}}
            {{Form::text('address',$company->address,['id'=>"address","class"=>"form-control"])}}
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

@endsection