@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if(count($planning) > 0)
      <h2 style="color:black;margin-bottom:70px;" class="text-center">Planning</h2>
      <a class="btn btn-default" style="margin-bottom:50px;" href="{{URL::previous()}}">Go Back</a>
        <table border="1" class="table table-bordred table-stripped table-condensed">
            <thead>
                <th><strong>Classroom</strong></th>
                <th><strong>Date Start</strong></th>
                <th><strong>Start Time</strong></th>
                <th><strong>End Time</strong></th>
                <th><strong>Reporter</strong></th>
                <th><strong>President</strong></th>
                <th><strong>Student</strong></th>    
                <th><strong>Company</strong></th>   
                <th><strong>Type</strong></th>       
            </thead>
            @foreach($planning as $key=>$defense)
               <tr>
                    <td rowspan="{{count($defense)}}" style="vertical-align:middle;">
                      <h3 class="text-center">{{$key}}</h3>
                    </td>
               @foreach($defense as $def)
                    <td>
                        {{$def['date_d']}}
                    </td>
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
                        {{App\Internship::find($def['internship'])->registration->studentRecord->firstname}} {{App\Internship::find($def['internship'])->registration->studentRecord->lastname}}
                   </td>
                   <td>
                       {{App\Internship::find($def['internship'])->companyFramer->managerCompany->name}}
                   </td>
                   <td>
                       {{App\Internship::find($def['internship'])->type}}
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