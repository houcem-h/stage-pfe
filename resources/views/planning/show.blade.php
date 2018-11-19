@extends('dashboards.admin.appdash')
@section('dash_content')
{{-- start bs deletion  bs modal--}}
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
        {!!Form::open(['method'=>"POST","action"=>["PlanningController@destroy",1]])!!}
           {{Form::hidden('_method','DELETE')}}
           {{Form::submit('Supprimer',['class'=>"btn btn-danger pull-right"])}}
       {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
 {{--end deletion  bs modal --}}
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if(count($planning) > 0)
        <h2 style="color:black;margin-bottom:70px;margin-top:50px;" class="text-center">Planning Init &amp; Perf</h2>
        <button type="button" class="btn btn-danger pull-right" style="margin-bottom:50px;" data-toggle="modal" data-target="#modaldeletedefenses">Supprimer</button>
        <a class="btn btn-primary" style="margin-bottom:50px;" href="{{URL::previous()}}">< Arriére</a>
        <a class="btn btn-warning" style="margin-bottom:50px;" href="/defences/updating">Modifier</a>
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
                    <td  rowspan="{{count($defense)}}" style="vertical-align:middle;padding:0px 12px 0px 12px;">
                      <h3 class="text-center">{{$key}}</h3>
                      <p class="text-success">{{Carbon\Carbon::parse($defense[0]['date_d'])->toFormattedDateString()}}</p>
                    </td>
               @foreach($defense as $def)
                    <td>
                        {{$def['start_time']}}
                    </td>          
                    <td>
                        {{$def['end_time']}}
                    </td> 
                    <td>
                        {{$def->reporterRecord->firstname}} {{$def->reporterRecord->lastname}}/ {{$def->presidentRecord->firstname}} {{$def->presidentRecord->lastname}}
                    </td>

                   <td>
                       {{$def->internships->registration->studentRecord->firstname}} {{$def->internships->registration->studentRecord->lastname }}
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