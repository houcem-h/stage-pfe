@extends('dashboards.admin.appdash')
@section('dash_content')
      <div class="col-md-12">
         @if(Request::instance()->get('l')==1)
           <h2 class="text-center" style="margin:50px 0px 55px 0px;color:black;">Planning Init & Perf  Internships</h2>
         @else
          <h2 class="text-center" style="margin-bottom:55px;color:black;">Planning PFE Internships</h2>
         @endif

   @if(isset($done) && $done=='false')         
      @if(!isset($nbr_salles_first_day))
         <div class="panel panel-default col-md-6 col-md-offset-3">
             <div class="panel-heading">
               <h3 class="text-center">Info Planning</h3>
             </div>
           
             <div class="panel-body">
                {!!Form::open(["action"=>"PlanningController@restrictions","method"=>"POST",'id'=>'formplanninginfo'])!!}

                   <div class="form-group" id="formgroupforfirstday">
                        {{Form::label('startdate','Start Date')}}
                        {{Form::date('startdate','',['class'=>'form-control','id'=>"startdate"])}}
                    </div>

                    <div class="form-group" id="formgroupforsecondday">
                        {{Form::label('startdate2','Date Second Day')}}
                        {{Form::date('startdate2','',['id'=>"startdate2",'class'=>"form-control"])}}
                    </div>

                    <div class="form-group" >
                        {{Form::label('starttime','Start Time first day')}}
                        {{Form::time('starttime','',['class'=>'form-control','id'=>"starttime"])}}
                    </div>

                    <div class="form-group" id="divendtime">
                        {{Form::label('endtime','End Time first Day')}}
                        {{Form::time('endtime','',['class'=>'form-control','id'=>"endtime"])}}
                    </div>  

                    <div class="form-group">
                        {{Form::label('starttimesecondday','start time second day')}}
                        {{Form::time('starttimesecondday','',['class'=>"form-control",'id'=>"starttimesecondday"])}}
                    </div>

                    <div class='form-group'>
                        {{Form::label('endtimesecondday','end time second day')}}
                        {{Form::time('endtimesecondday','',['class'=>"form-control",'id'=>"endtimesecondday"])}}
                    </div>
                
                    <div class="form-group">
                        {{Form::label('defenceduration','Defence Init Duration(in minutes)')}}
                        {{Form::number('defenceduration','',['class'=>'form-control','id'=>"defenceduration"])}}
                    </div>  
                    <div class="form-group">
                        {{Form::label('defenceperfduration','Defence Perf Duration(in minutes)')}}
                        {{Form::number('defenceperfduration','',['class'=>'form-control','id'=>"defenceperfduration"])}}
                    </div>          
                    {{Form::hidden('l',Request::instance()->get('l'))}}                                 
                    {{Form::submit('Validate',['class'=>"btn btn-default"])}}
                {!!Form::close()!!}
             </div>
             <div class="panel-footer">
                 <p></p><br>
             </div>
         </div>
         @else
         <div class="row">    
               <div id="donebutton" class="col-md-2 pull-right" style="margin:10px 30px 30px 0px;">
                  <h1 class="text-center">Validate Planning</h1>
              </div>
        </div>
              <div class="panel panel-default col-md-3">
                 <div class="panel-heading">
                     <h3 class="text-center">Choose Classrooms First Day</h3>
                 </div>
                 <div class="panel-body">
                  {!!Form::open(["action"=>"PlanningController@store","method"=>"POST","id"=>"formclassroomsfirstday"])!!}
                     @for($i=0;$i<$nbr_salles_first_day;$i++)
                        <div class="form-group">
                            {{Form::label('classroom_first_day'.($i+1),'Classroom n'.($i+1))}}
                            {{Form::text('classroom_first_day'.($i+1),'',['class'=>"form-control classroominputfield",'id'=>"classroom_first_day".($i+1)])}}
                        </div>
                     @endfor
                     {{Form::submit('Validate',['class'=>'btn btn-default','style'=>'visibility:hidden;'])}}
                     <br><br>
                  {!!Form::close()!!} 
                </div>
              </div>

           <div class="panel panel-default col-md-3">
                 <div class="panel-heading">
                     <h3 class="text-center">Choose Classrooms Second Day</h3>
                 </div>
                 <div class="panel-body">
                  {!!Form::open(["action"=>"PlanningController@store","method"=>"POST","id"=>"formclassroomssecondday"])!!}
                     @for($i=0;$i<$nbr_salles_second_day;$i++)
                        <div class="form-group">
                            {{Form::label('classroom_second_day'.($i+1),'Classroom n'.($i+1))}}
                            {{Form::text('classroom_second_day'.($i+1),'',['class'=>"form-control classroominputfield",'id'=>"classroom_second_day".($i+1)])}}
                        </div>
                     @endfor
                     {{Form::submit('Validate',['class'=>'btn btn-default','style'=>'visibility:hidden;'])}}
                     <br><br>
                  {!!Form::close()!!} 
                </div>
              </div>

              <div class="panel panel-default col-md-3" >
                 <div class="panel-heading">
                     <h3 class="text-center">First Day Juries</h3>
                 </div>             
                 <div class="panel-body">
                     <p style="color:red;font-size:19px;" ><u id="alo">Choose at least {{$nbr_juries_first_day}} juries</u></p>
                    <h3 class="pull-right" id="counterjuriesfirstday"></h3>
                     <form id="formjuriesfirstday" method="POST">
                            @foreach($juries->all() as $jurie)
                               <div class="form-group" id="firstdaysjuiesdiv">
                                  <input type="checkbox" name="jurie_first_day{{$jurie->id}}" id="jurie_first_day{{$jurie->id}}" class="checkedjuries" value="{{$jurie->id}}" style="margin-right:15px;"><label for="jurie{{$jurie->id}}"><strong>{{$jurie->firstname}} {{$jurie->lastname}} : </strong></label>
                                </div>    
                            @endforeach
                     </form>
                 </div>
              </div>

             <div class="panel panel-default col-md-3">
                 <div class="panel-heading">
                     <h3 class="text-center">Second Day Juries</h3>
                 </div>             
                 <div class="panel-body">
                     <p style="color:red;font-size:19px;"><u id="alt">Choose at least {{$nbr_juries_second_day}} juries</u></p>
                     <h3 class="pull-right" id="counterjuriessecondday"></h3>
                     <form id="formjuriessecondday" method="POST">
                            @foreach($juries->all() as $jurie)
                               <div class="form-group" id="seconddaysjuiesdiv">
                                  <input type="checkbox" name="jurie_second_day{{$jurie->id}}" id="jurie_second_day{{$jurie->id}}" class="checkedjuries" value="{{$jurie->id}}" style="margin-right:15px;"><label for="jurie{{$jurie->id}}"><strong>{{$jurie->firstname}} {{$jurie->lastname}} : </strong></label>
                                </div>    
                            @endforeach
                     </form>
                 </div>
              </div>
                     <p style="visibility:hidden;" id="levelintern">{{$level}}</p>
                     <p style="visibility:hidden;" id="nbrjfd">{{$nbr_juries_first_day}}</p>
                     <p style="visibility:hidden;" id="nbrjsd">{{$nbr_juries_second_day}}</p>
                     <p style="visibility:hidden;" id="start_date_first_day">{{$start_date_first_day}}</p>
                     <p style="visibility:hidden;" id="def_start_time_first_day">{{$start_time_first_day}}</p>
                     <p style="visibility:hidden;" id="def_legal_duration_first_day">{{$legal_duration_first_day}}</p>
                     <p style="visibility:hidden;" id="init_duration">{{$init_duration}}</p>

                     <p style="visibility:hidden;" id="start_date_second_day">{{$start_date_second_day}}</p>
                     <p style="visibility:hidden;" id="def_start_time_second_day">{{$start_time_second_day}}</p>
                     <p style="visibility:hidden;" id="def_legal_duration_second_day">{{$legal_duration_second_day}}</p>
                     <p style="visibility:hidden;" id="perf_duration">{{$perf_duration}}</p>
         @endif
    @else
        <div class="jumbotron col-md-6 col-md-offset-3">
            <div class="row">
                <h3 class="text-center" style="color:black;">Planning Has Been Already Done By  
                    @if(isset($done) && $done->id==auth()->user()->id)
                      You
                    @else
                      Mr {{$done->firstname}} {{$done->lastname}}
                    @endif
                </h3><br><br>
            </div>
            <div class="row">
                <div class="col-md-4">
                  <center><a href="/planning/{{Request::instance()->get('l')}}" class="btn btn-success">Preview</a></center>
                </div>
               {{--  <div class="col-md-4"> 
                  <center><a href="/planning/{{Request::instance()->get('l')}}/edit" class="btn btn-primary">Update</a></center>
               </div>  --}}
               <div class="col-md-4">
                   <center>{!!Form::open(['method'=>"POST","action"=>["PlanningController@destroy",Request::instance()->get('l')]])!!}
                     {{Form::hidden('_method','DELETE')}}
                     {{Form::submit('Delete',['class'=>"btn btn-danger",'style'=>"margin-bottom:30px;"])}}
                   {!!Form::close()!!}</center>
               </div>
      
    @endif     
    <div class="col-md-6 col-md-offset-3 alert alert-danger" style="display:none;" id="errorsplanning">
        
    </div>        
      </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ajaxobject.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ajaxstuffplanning.js')}}"></script>
@endsection