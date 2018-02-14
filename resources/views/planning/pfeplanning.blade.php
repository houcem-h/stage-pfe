@extends('dashboards.admin.appdash')
@section('dash_content')
<div class="container">
  <div class="row">
      <div class="col-md-12">
          <div class="row">
    <div class="col-md-6 col-md-offset-3 panel panel-default" style="background-color:white;margin-top:60px;">
       <div class="panel-heading">
           <h3 class="text-center" style="margin-top:20px;">PFE Planning</h3>
       </div>
       <div class="panel-body">
          {!!Form::open(['method'=>'POST','url'=>"pferestrictions",'id'=>'formplanningpfe','style'=>'padding-top:50px;'])!!}
            <div class="form-group">
                {{Form::label('nbrdays','Choose Days Number')}}
                <span style="margin-right:20px;margin-left:10px;">{{Form::radio('nbrdays','1',true)}}</span><span style="margin-right:20px;"> {{Form::radio('nbrdays','2',false)}}</span><span>{{Form::radio('nbrdays','3')}}</span>
            </div>
            <div id="appenddatesandtimesinputs">
               <div class="form-group">
                   {{Form::label('date_first_day','Date Day 1')}}
                   {{Form::date('date_first_day','',['class'=>'form-control','id'=>"date_first_day"])}}
               </div>
               <div class="form-group">
                   {{Form::label('start_time_first_day','Start Time Day 1')}}
                   {{Form::time('start_time_first_day','',['class'=>'form-control','id'=>'start_time_first_day'])}}
               </div>
               <div class="form-group">
                   {{Form::label('end_time_first_day','End Time Day 1')}}
                   {{Form::time('end_time_first_day','',['class'=>'form-control','id'=>'end_time_first_day'])}}
               </div>
            </div>
            <div class="form-group">
                 {{Form::label('pfe_duration','PFE Defense duration')}}
                 {{Form::number('pfe_duration','',['class'=>'form-control','id'=>'pfe_duration'])}}
            </div>
            {{Form::submit('Validate',['class'=>'btn btn-default'])}}
            {!!Form::close()!!}
       </div>
       <div class="panel-footer">
           <br><br>
       </div>
    </div>
  </div>
</div>
</div>
</div>
 <script type="text/javascript" src="{{asset('js/pfeplanningstuff.js')}}"></script>
@endsection