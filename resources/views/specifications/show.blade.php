@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="{{URL::previous()}}" class="btn btn-default" style="margin-bottom:50px;">Go Back</a>
         @if(isset($spec))
           <div class="panel panel-default">
               <div class="panel-heading">
                  <h4 class="text-center">Specifications Of 
                      @if(isset($spec->adminCreator->firstname) && isset($spec->adminCreator->lastname))
                       <a href="/students/{{$spec->adminCreator->id}}"> 
                        {{$spec->adminCreator->firstname}} 
                        {{$spec->adminCreator->lastname}}
                      </a>
                      @endif
                       PFE Internship </h4>
               </div>
               <div class="panel-body">
                 <table class="table table-bordred">
                  <tr>
                      <td><strong>Title : </strong></td>
                      <td>{{$spec->title}}</td>
                  </tr>  
                  <tr>
                      <td><strong>Project Type : </strong></td>
                      <td>{{$spec->project_type}}</td>
                  </tr>
                  <tr>
                      <td><strong>Existing Description : </strong></td>
                      <td>{{$spec->existing_desc}}</td>
                  </tr> 
                  <tr>
                      <td><strong>Requirement Specifications</strong></td>
                      <td>{{$spec->requirement_spec}}</td>
                  </tr>
                  <tr>
                      <td><strong>Hardware Environment</strong></td>
                      <td>{{$spec->hardware_env}}</td>
                  </tr>
                  <tr>
                      <td><strong>Software Environment</strong></td>
                      <td>{{$spec->software_env}}</td>
                  </tr>
                  <tr>
                      <td><strong>Provisional Planning</strong></td>
                      <td>{{$spec->provisional_planning}}</td>
                  </tr>
                 </table>
               </div>
               <div class="panel-footer">
                <a class="btn btn-primary" href="/specifications/{{$spec->id}}/edit">Edit</a>
               </div>    
           </div>
         @endif
 
        </div>
    </div>
</div>
@endsection