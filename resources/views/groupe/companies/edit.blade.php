@extends('layouts.app')
@section('content')
<div class="container">
  <div class="col-md-6 col-md-offset-3">
      <a href="/company" style="margin-bottom:50px;" class="btn btn-default">List of Companies</a>
       
      {!!Form::open(['method'=>'POST','name'=>$company->id,'id'=>"formupdatecompany",'action'=>['CompaniesController@update',$company->id]])!!}
         <h3 class="text-center" style="color:black;"><b>Informations Societe</b></h3><br><hr><br>
      <div class="form-group">
            {{Form::label('name','Company Name')}}
            {{Form::text('name',$company->name,['class'=>"form-control","id"=>"name"])}}
        </div>

        <div class="form-group">
            {{Form::label('activity','Company Activity')}}
            {{Form::text('activity',$company->activity,['id'=>"activity",'class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::label('phone','Company Phone')}}
            {{Form::number('phone',$company->PhoneNumber,['class'=>"form-control",'id'=>"phone"])}}
        </div>

        <div class="form-group">
            {{Form::label('fax','Company Fax')}}
            {{Form::number('fax',$company->FaxNumber,['id'=>'fax','class'=>"form-control"])}}
        </div>

        <div class="form-group">
            {{Form::label('address','Company Adress')}}
            {{Form::text('address',$company->address,['id'=>"address","class"=>"form-control"])}}
        </div>

       <div class="form-group">
         {{Form::hidden('_method','PUT')}}
         {{Form::submit('Update',['class'=>"btn btn-default"])}}
       </div>
      {!!Form::close()!!}
    <div style="display:none;" id="errorsajax" class="col-md-6 col-md-offset-3">
    </div>
    
    <div style="display:none;" id="successajax" class="col-md-6 col-md-offset-3">
    </div>
  </div>
</div>
 <script type="text/javascript" src="{{ asset('js/mainajax.js') }}"></script>
@endsection