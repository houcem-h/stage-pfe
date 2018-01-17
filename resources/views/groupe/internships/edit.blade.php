@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="row">
            {!!Form::open(["method"=>"POST","url"=>"/internships/store","class"=>"formcreateinternship"])!!}
              <div class="form-group">
               {{Form::label('start_date',"Date Début")}}
               {{Form::date('start_date',$internship->start_date,['id'=>"start_date","class"=>"form-control"])}}
              </div>
              <div class="form-group">
                {{Form::label('end_date','Date Fin')}}
                {{Form::date('end_date',$internship->end_date,['id'=>'end_date','class'=>"form-control"])}}
              </div>
              <div class="form-group">
                  {{Form::label('type','Type')}}
                  {{Form::select('type',['init'=>"initiation",'perf'=>'perfectionnement','pfe'=>'PFE'],null,['id'=>"type",'class'=>'form-control'])}}
              </div>
              <div class="form-group">
                  {{Form::label('framer','Encadreur Etablissement')}}
                  {{Form::select('framer',['1'=>"Houcem Hedhli"],null,['id'=>'framer','class'=>'form-control'])}}
              </div>
            {{Form::submit('Enregistrer',['class'=>'btn btn-default'])}}
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection