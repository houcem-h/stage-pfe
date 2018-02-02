@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="row">
           
              <div id="animationloadingbarcontainer">
                  <div  id="bar"></div>
               </div>  

            
                 @if(isset($internship) && isset($managerTeachers))
                    {!!Form::open(["method"=>"POST","url"=>"/internships/update/".$internship->id,"class"=>"formcreateinternship","id"=>"formeditinternship"])!!}
                            <h3 class="text-center" style="color:black;"><b>Informations du Stage</b></h3><br><hr><br>
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
                                {{Form::text('type',$internship->type,['disabled'=>'disabled','class'=>'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('framer','Encadreur Etablissement')}}
                                @if(Session::has('framerRecord') && Session::get('framerRecord')!="" && Session::get('framerRecord')!=null)
                                    {{Form::select('framer',(array)$managerTeachers,(int)Session::get('framerRecord'),['id'=>'framer','class'=>'form-control'])}}
                                    {{Session::forget('framerRecord')}}
                                @else
                                    {{Form::select('framer',(array)$managerTeachers,null,['id'=>'framer','class'=>'form-control'])}}
                                @endif
                                </div>
                            {{Form::hidden('_method','PUT')}}
                            {{Form::submit('Confirmer',['class'=>'btn btn-default'])}}
                    {!!Form::close()!!}
                @endif
        </div>
    </div>
</div>
@endsection