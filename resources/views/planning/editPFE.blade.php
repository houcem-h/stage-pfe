@extends('dashboards.admin.appdash')
@section('dash_content')
  <div class="container">
  <h3 class="text-center" style="margin-top:40px;">Modifier Soutenances PFE</h3>
  
 <button  disabled class="btn btn-success" id="btnsavefedchanges" style="margin:50px 0px 50px 0px;">Enregistrer</button>
    <p>Drag &amp; Drop la soutenance dans sa nouvelle position, (<strong>modification possible pour les soutenances dans la meme salle</strong>)</p>
    <div class="row">
     <table border="1" id="listdrops" class="table table-bordred table-stripped table-condensed" style="background-color:white;">
        @foreach($defenses as $key=>$defense)
          <tr class="ignoredindandr" style="background-color:#2d3436;color:white;">
               <th colspan="10"><h2><center>{{$key}}</center></h2></th>
          <tr>
          <tr class="ignoredindandr" style="background-color:lightgrey;color:black;">
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
          </tr>
           <tbody>
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
                       {{$def->reporterRecord->firstname}} {{$def->reporterRecord->lastname}}
                    </td>
                    <td>
                       {{$def->presidentRecord->firstname}} {{$def->presidentRecord->lastname}}
                    </td>
                    <td>
                        {{$def->internships->framerRecord->firstname}} {{$def->internships->framerRecord->lastname}} 
                    </td>
                    <td>
                        {{$def->internships->registration->studentRecord->firstname}}   {{$def->internships->registration->studentRecord->lastname}}
                    </td>
                    <td>
                        @if($def->internships->registrationSecondStudent!=null)
                           {{$def->internships->registrationSecondStudent->studentRecord->firstname }} {{$def->internships->registrationSecondStudent->studentRecord->lastname}}
                        @else
                        <center>---</center>
                        @endif
                    </td>
                    <td>
                       {{$def->internships->companyFramer->managerCompany->name}}
                    </td>
                    <td>
                      {{$def->internships->registration->groupRecord->stream}}
                    </td>                                                                    
                </tr> 
              @endforeach
              </tbody>
            @endforeach
          </table>
    </div>
</div>
@endsection
 <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/moovingpfedefense.js')}}"></script>