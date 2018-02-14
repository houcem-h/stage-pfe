@extends('dashboards.admin.appdash')
@section('dash_content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if(count($planning) > 0)
    
      <h2 style="color:black;margin-bottom:70px;margin-top:50px;" class="text-center">Planning Init &amp; Perf</h2>
       {!!Form::open(['method'=>"POST","action"=>["PlanningController@destroy",1]])!!}
           {{Form::hidden('_method','DELETE')}}
           {{Form::submit('Delete',['class'=>"btn btn-danger pull-right",'style'=>"margin-bottom:30px;"])}}
      {!!Form::close()!!}
      <a class="btn btn-primary" style="margin-bottom:50px;" href="{{URL::previous()}}">Go Back</a>

        <table border="1" class="table table-bordred table-stripped table-condensed" style="background-color:white;">
            <thead>
                <th><strong>Classroom</strong></th>
                <th><strong>Start Time</strong></th>
                <th><strong>End Time</strong></th>
                <th><strong>Jurie1/Jurie2</strong></th>
                <th><strong>Student</strong></th>    
                <th><strong>Company</strong></th>   
                <th><strong>Branch</strong></th>    
            </thead>
            @foreach($planning as $key=>$defense)
               <tr>
                    <td  rowspan="{{count($defense)}}" style="vertical-align:middle;padding:0px 8px 0px 8px;">
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
                        {{App\User::find($def['reporter'])->firstname}} {{App\User::find($def['reporter'])->lastname}}/ {{App\User::find($def['president'])->firstname}}/{{App\User::find($def['president'])->lastname}}
                    </td>

                   <td>
                        {{App\Internship::find($def['internship'])->registration->studentRecord->firstname}} {{App\Internship::find($def['internship'])->registration->studentRecord->lastname}}
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