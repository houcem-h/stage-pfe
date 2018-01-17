@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="row">
            <a class="btn btn-default" style="margin-bottom:50px;" href="{{URL::previous()}}">Go Back</a>
        @if(isset($internship))
          <div class="panel panel-default">
              <div class="panel-heading">
                 <p class="text-center"> <strong>Type : </strong> {{ $internship->type}} </p>
              </div>
              <div class="panel-body">
                  <table class="table table-bordred">
                      <tr>
                       <td><strong>Student</strong></td>
                       <td><a href="">{{$internship->registration->studentRecord->firstname}}</a></td>
                      </tr>
                      <tr>
                        <td><strong>start_date</strong></td>
                        <td>{{$internship->start_date}}</td>
                     </tr>
                    <tr>
                        <td><strong>end_date</strong></td>
                        <td>{{$internship->end_date}}</td>
                    </tr>
                    @if(isset($internship->framerRecord))
                    <tr>
                        <td><strong>establishment_framer</strong></td>
                        <td><a href="">{{$internship->framerRecord->firstname}} {{$internship->framerRecord->lastname}}</a></td>
                    </tr>
                    @endif        
                    <tr>
                        <td><strong>company_framer</strong></td>
                        <td><a href="{{URL('/companiesmanagers/'.$internship->company_framer)}}">{{$internship->companyFramer->name}}</a></td>
                    </tr>
                    <tr>
                        <td><strong>created_by</strong></td>
                        <td>{{$internship->adminCreator or "not set"}}</td>
                    </tr>
                    <tr>
                        <td><strong>updated_by</strong></td>
                        <td>{{$internship->adminUpdator or "not set"}}</td>
                    </tr> 
                    <tr>
                        <td><strong>created_at</strong></td>
                        <td>{{$internship->created_at or "not set"}}</td>
                    </tr>  
                    <tr>
                        <td><strong>updated_by</strong></td>
                        <td>{{$internship->updated_at or "not set"}}</td>
                    </tr>                                                                                    
                  </table>
              </div>
              <div class="panel-footer">
               <p></p><br>
              </div>
          </div>
        @endif
        </div>
    </div>
</div>
@endsection