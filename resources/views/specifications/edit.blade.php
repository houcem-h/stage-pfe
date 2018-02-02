@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
          
    @if(isset($specification))    
        {!!Form::open(["method"=>"POST",'action'=>["SpecificationsController@update",$specification->id],'id'=>"forupdatespecification"])!!}
              <h3 class="text-center" style="color:black;"><b>Specifications</b></h3><br><hr><br>       
               <div class="form-group">
                   {{Form::label('title','Titre projet')}}
                   {{Form::textarea('title',$specification->title,['class'=>"form-control",'id'=>'title'])}}
               </div>
               <div class="form-group">
                   {{Form::label('project_type','Type Du Projet')}}
                   {{Form::textarea('project_type',$specification->project_type,['class'=>"form-control",'id'=>'project_type'])}}
                </div>      
                <div class="form-group">
                   {{Form::label('existing_desc','Description de l existant')}}
                   {{Form::textarea('existing_desc',$specification->existing_desc,['class'=>"form-control",'id'=>'existing_desc'])}}
                </div>  
                <div class="form-group">
                   {{Form::label('requirement_spec','Spécification des besions')}}
                   {{Form::textarea('requirement_spec',$specification->requirement_spec,['class'=>"form-control",'id'=>'requirement_spec'])}}
                </div>
                <div class="form-group">
                   {{Form::label('hardware_env','Environnement matériel')}}
                   {{Form::textarea('hardware_env',$specification->hardware_env,['class'=>"form-control",'id'=>'hardware_env'])}}
                </div>  
                <div class="form-group">
                   {{Form::label('software_env','Environnement logiciel')}}
                   {{Form::textarea('software_env',$specification->software_env,['class'=>"form-control",'id'=>'software_env'])}}
                </div>                
                <div class="form-group">
                   {{Form::label('provisional_planning','Planning prévisionnel')}}
                     {{Form::textarea('provisional_planning',$specification->provisional_planning,['class'=>"form-control",'id'=>'provisional_planning'])}}                   
                </div>
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Confirmer',['class'=>'btn btn-default'])}}                                                
        {!!Form::close()!!}
        @else 
    @endif
        </div>
    </div>
</div>
@endsection