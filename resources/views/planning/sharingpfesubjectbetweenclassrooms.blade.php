@extends('dashboards.admin.appdash')
@section('dash_content')
  <div class="row">
      <div class="col-md-12">
        <button class="btn btn-primary" id="planningvalidated" style="margin-top:50px;">Validate Planning</button>
        <div class="row">
          <div class="col-md-9" style="margin-top:50px;">
              @if(isset($data) && count($data)>0)
               <p style="display:none;" id="pfe_def_dur">{{$data['duration']}}</p>
                @if($data['nbr_days'] == 1)
                <div id="div_first_day">
                <p style="display:none;" id="pdate_first_day">{{$data['date_first_day']}}</p>
                <p style="display:none;" id="pstart_time_first_day">{{$data['start_time_first_day']}}</p>
                    <h3 class="text-center" style="margin-bottom:50px;">First Day</h3>
                    <button class="btn btn-success pull-right" id="addclassinfirstday">Add classroom</button>
                    <div class="row">
                    @for($i=0;$i<$data['nbr_classrooms_first_day'];$i++)
                        <div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;">
                           <div>
                            <input type="text" placeholder="choose classroom name" class="form-control classesnames" style="border:none;outline-decoration:none;width:100%;" name="classname"/>
                           </div>
                            <hr style="background-color:black;">
                           <div class="classroom col-xs-12" date="{{$data['date_first_day']}}" time="{{$data['start_time_first_day']}}"  style="height:100%;width:100%;">

                           </div>
                        </div>
                    @endfor
                      </div>
                      </div>
                @elseif($data['nbr_days'] == 2)
                <p style="display:none;" id="pdate_first_day">{{$data['date_first_day']}}</p>
                <p style="display:none;" id="pstart_time_first_day">{{$data['start_time_first_day']}}</p>
                <p style="display:none;" id="pdate_second_day">{{$data['date_second_day']}}</p>
                <p style="display:none;" id="pstart_time_second_day">{{$data['start_time_second_day']}}</p>                                
                   <h3 class="text-center" style="margin-bottom:50px;">First Day</h3>
                    <button class="btn btn-success pull-right" id="addclassinfirstday">Add classroom</button>
                   <div class="row" id="div_first_day">
                    @for($i=0;$i<$data['nbr_classrooms_first_day'];$i++)
                       <div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;">
                           <div>
                            <input placeholder="choose classroom name" type="text" class="form-control classesnames" style="border:none;outline-decoration:none;width:100%;" name="classname"/>
                           </div>
                            <hr style="background-color:black;">
                           <div class="classroom col-xs-12" date="{{$data['date_first_day']}}" time="{{$data['start_time_first_day']}}"  style="height:100%;width:100%;">

                           </div>
                        </div>
                    @endfor
                      </div>
                    <hr style="color:black;background-color:black;line-height:5px;"/>
                   <h3 class="text-center" style="margin-bottom:50px;">Second Day</h3>
                    <button class="btn btn-success pull-right" id="addclassinsecondday">Add classroom</button>
                   <div class="row" id="div_second_day">
                    @for($i=0;$i<$data['nbr_classrooms_second_day'];$i++)
                       <div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;">
                           <div>
                            <input placeholder="choose classroom name" type="text" class="form-control classesnames" style="border:none;outline-decoration:none;width:100%;" name="classname"/>
                           </div>
                            <hr style="background-color:black;">
                           <div class="classroom col-xs-12" date="{{$data['date_second_day']}}" time="{{$data['start_time_second_day']}}"  style="height:100%;width:100%;">

                           </div>
                        </div>                                                
                    @endfor
                      </div>
                @else
                <p style="display:none;" id="pdate_first_day">{{$data['date_first_day']}}</p>
                <p style="display:none;" id="pstart_time_first_day">{{$data['start_time_first_day']}}</p>
                <p style="display:none;" id="pdate_second_day">{{$data['date_second_day']}}</p>
                <p style="display:none;" id="pstart_time_second_day">{{$data['start_time_second_day']}}</p>
                <p style="display:none;" id="pdate_third_day">{{$data['date_third_day']}}</p>
                <p style="display:none;" id="pstart_time_third_day">{{$data['start_time_third_day']}}</p> 

                <h3 class="text-center" style="margin-bottom:50px;">First Day</h3>
                    <button class="btn btn-success pull-right" id="addclassinfirstday">Add classroom</button>
                    <div class="row" id="div_first_day">
                      @for($i=0;$i<$data['nbr_classrooms_first_day'];$i++)
                       <div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;">
                           <div>
                           <input placeholder="choose classroom name" type="text" class="form-control classesnames" style="border:none;outline-decoration:none;width:100%;" name="classname"/>
                           </div>
                           <hr style="background-color:black;">
                           <div class="classroom col-xs-12" date="{{$data['date_first_day']}}" time="{{$data['start_time_first_day']}}"  style="height:100%;width:100%;">
                              
                           </div>
                        </div>
                      @endfor
                      </div>
                     <hr style="color:black;background-color:black;line-height:5px;"/>
                     <h3 class="text-center" style="margin-bottom:50px;">Second Day</h3>
                     <button class="btn btn-success pull-right" id="addclassinsecondday">Add classroom</button>
                     <div class="row" id="div_second_day">
                      @for($i=0;$i<$data['nbr_classrooms_second_day'];$i++)
                       <div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;">
                           <div>
                            <input placeholder="choose classroom name" type="text" class="form-control classesnames" style="border:none;outline-decoration:none;width:100%;" name="classname"/>
                           </div>
                            <hr style="background-color:black;">
                           <div class="classroom col-xs-12" date="{{$data['date_second_day']}}" time="{{$data['start_time_second_day']}}"  style="height:100%;width:100%;">

                           </div>
                        </div>
                      @endfor    
                      </div> 
                      <hr style="color:black;background-color:black;line-height:5px;"/> 
                      <h3 class="text-center" style="margin-bottom:50px;">Third Day</h3>
                      <button class="btn btn-success pull-right" id="addclassinthirdday">Add classroom</button>
                      <div class="row" id="div_third_day">
                      @for($i=0;$i<$data['nbr_classrooms_third_day'];$i++)
                       <div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;">
                           <div>
                             <input placeholder="choose classroom name" type="text" class="form-control classesnames" style="border:none;outline-decoration:none;width:100%;" name="classname"/>
                           </div>
                           <hr style="background-color:black;">
                           <div class="classroom" date="{{$data['date_third_day']}}" time="{{$data['start_time_third_day']}}" style="height:100%;width:100%;">
 
                           </div>
                        </div>
                      @endfor       
                      </div>          
                @endif
              @endif
          </div>
          <div class="col-md-3 pull-right" id="sourceframers" style="background-color:white;">
            <h3 class="text-center">Framers</h3>
           <br>
            <hr style="background-color:black;">
            @foreach($framers as $framer)
             <p class="draggableframers" data="{{$framer['id']}}"><i style="padding:5px;font-size:20px;" class="fa fa-user-circle"></i><strong style="margin-bottom:20px;">{{$framer['firstname']}} {{$framer['lastname']}}</strong><br><small>(have {{App\Internship::where('type','pfe')->where('framer',$framer['id'])->whereYear('start_date',date('Y'))->count()}} internships)</small></p>
            @endforeach
            <br>
          
             <br>
              <h3 class="text-center">Teachers</h3><br>
              <hr style="background-color:black;">
             @foreach($notframers as $framer)
               <p class="draggableframers" data="{{$framer['id']}}"><i  style="padding:5px;font-size:20px;" class="fa fa-user-circle"></i><strong style="margin-bottom:20px;" >{{$framer['firstname']}}</strong></p>
             @endforeach           
          </div>
        </div>
    </div>
 </div>
 <script type="text/javascript" src="{{asset('js/pfeplanningstuff.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/drag&drop.js')}}"></script>
@endsection