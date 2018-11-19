@extends('dashboards.admin.appdash')
@section('dash_content')
<div class="container">
  <h3 class="text-center" style="margin-top:40px;">Modifier Soutenances Init &amp; Perf</h3>
 <button  disabled class="btn btn-success" id="btnsavefedchanges" style="margin:50px 0px 50px 0px;">Enregistrer</button>
      <p>Drag &amp; Drop la soutenance dans sa nouvelle position</p>
    <div class="row">
     <table border="1" id="listdrops" class="table table-bordred table-stripped table-condensed" style="background-color:white;">
      <tbody>
        @foreach($defenses as $key=>$defense)
          <tr class="ignoredindandr" style="background-color:#2d3436;color:white;">
               <th colspan="7"><h2><center>{{$key}}</center></h2></th>
          <tr>
          <tr class="ignoredindandr" style="background-color:lightgrey;color:black;">
                <th><strong>Classroom</strong></th>
                <th><strong>Start Time</strong></th>
                <th><strong>End Time</strong></th>
                <th><strong>Jurie1/Jurie2</strong></th>
                <th><strong>Student</strong></th>    
                <th><strong>Company</strong></th>   
                <th><strong>Branch</strong></th>    
          </tr>
               @foreach($defense as $def)
                <tr id="{{$def->id}}">
                    <td>
                      <h5 class="text-center classroom-name">{{$key}}</h5>
                      <small class="classroom-start-time">{{Carbon\Carbon::parse($def->date_d)->toFormattedDateString()}}</small>
                    </td>
                    <td>
                        {{$def->start_time}}
                    </td>          
                    <td>
                        {{$def->end_time}}
                    </td> 
                    <td>
                        {{$def->reporterRecord->firstname}} {{$def->reporterRecord->lastname}}/ {{$def->presidentRecord->firstname}} {{$def->presidentRecord->lastname}}
                    </td>
                    <td>
                        {{$def->internships->registration->studentRecord->firstname}} {{$def->internships->registration->studentRecord->lastname}}
                    </td>
                    <td>
                        {{$def->internships->companyFramer->managerCompany->name}}
                    </td>
                    <td>
                        {{$def->internships->registration->groupRecord->stream}}
                    </td>                                                        
                </tr> 
              @endforeach
            @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
 <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/moovingdefense.js')}}"></script>