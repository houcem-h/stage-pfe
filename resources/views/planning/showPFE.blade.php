@extends('dashboards.admin.appdash')
@section('dash_content')
<div class="container">
{{--modal begin--}}
<div class="modal fade" id="modaldeletedefenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerte ! </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>voulez vous vraiment supprimer la planification des soutenances ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      {!!Form::open(['method'=>"POST","action"=>["PlanningController@destroy",3]])!!}
           {{Form::hidden('_method','DELETE')}}
           {{Form::submit('Delete',['class'=>"btn btn-danger"])}}
      {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
{{--modal end--}}
  <div class="row">
    <div class="col-md-12">
    @if(count($planning) > 0)
      <h2 style="color:black;margin-bottom:70px;margin-top:50px;" class="text-center">Planning PFE</h2>
      <button class="btn btn-danger pull-right" style="margin-bottom:30px;" type="button" data-toggle="modal" data-target="#modaldeletedefenses">Supprimer</button>
      <a class="btn btn-primary" style="margin-bottom:50px;" href="{{URL::previous()}}">Go Back</a>
      <a class="btn btn-warning" style="margin-bottom:50px;" href="/defenses/pfe/updating">Modifier</a>  
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
                       <p class="text-success">{{Carbon\Carbon::parse($defense[0]['date_d'])->toFormattedDateString()}}</p>
                    </td>
               @foreach($defense as $def)
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
            @endforeach
        </table>
      @endif
    </div>
  </div>
</div>
@endsection