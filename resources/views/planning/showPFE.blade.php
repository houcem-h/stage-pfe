@extends('dashboards.admin.appdash')
@section('dash_content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if(count($planning) > 0)
    
      <h2 style="color:black;margin-bottom:70px;margin-top:50px;" class="text-center">Planning PFE</h2>
      {!!Form::open(['method'=>"POST","action"=>["PlanningController@destroy",3]])!!}
           {{Form::hidden('_method','DELETE')}}
           {{Form::submit('Delete',['class'=>"btn btn-danger pull-right",'style'=>"margin-bottom:30px;"])}}
      {!!Form::close()!!}
      <a class="btn btn-primary" style="margin-bottom:50px;" href="{{URL::previous()}}">Go Back</a>
        <table border="1" class="table table-bordred table-stripped table-condensed" style="background-color:white;">
            <thead>
                <th><strong>Classroom</strong></th>
                <th><strong>Start Time</strong></th>
                <th><strong>End Time</strong></th>
                <th><strong>Reporter</strong></th>
                <th><strong>President</strong></th>
                <th><strong>Framer</strong></th>    
                <th><strong>Student 1</strong></th>  
                <th style="padding:0px 5px 0px 5px;"><strong>Student 2</strong></th>  
                <th><strong>Company</strong></th>   
                <th><strong>Branch</strong></th>
                     
            </thead>
            @foreach($planning as $key=>$defense)
               <tr>
                    <td rowspan="{{count($defense)}}" style="vertical-align:middle;padding:0px 8px 0px 8px;">
                      <h3 class="text-center">{{$key}}</h3>
                       {{$defense[0]['date_d']}}
                    </td>
               @foreach($defense as $def)
                    <td>
                        {{$def['start_time']}}
                    </td>          
                    <td>
                        {{$def['end_time']}}
                    </td> 
                    <td>
                        {{App\User::find($def['reporter'])->firstname}} {{App\User::find($def['reporter'])->lastname}}
                    </td>
                    <td>
                        {{App\User::find($def['president'])->firstname}} {{App\User::find($def['president'])->lastname}}
                    </td>   
                    <td>
                       {{App\Internship::find($def['internship'])->framerRecord->firstname}} {{App\Internship::find($def['internship'])->framerRecord->lastname}}
                    </td>
                   <td>
                        {{App\User::find(App\Internship::find($def['internship'])->student)->firstname}}   {{App\User::find(App\Internship::find($def['internship'])->student)->lastname}}
                   </td>
                    <td>
                        @if(App\User::find(App\Internship::find($def['internship'])->student1)!=null)
                           {{App\User::find(App\Internship::find($def['internship'])->student1)->firstname }} {{App\User::find(App\Internship::find($def['internship'])->student1)->lastname}}
                        @else
                        <center>---</center>
                        @endif
                    </td>
                   <td>
                       {{App\Internship::find($def['internship'])->companyFramer->managerCompany->name}}
                   </td>
                   <td>
                      {{App\Internship::find($def['internship'])->registration->groupRecord->stream}}
                   </td>

                                                                                           
                </tr> 
              @endforeach
            @endforeach
        </table>
      @endif
    </div>
  </div>
</div>
@endsection