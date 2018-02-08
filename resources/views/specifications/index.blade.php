@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="{{URL::previous()}}" class="btn btn-default" style="margin-bottom:50px;">Go Back</a>
         @forelse($specifications as $spec)
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
                      <td><strong>Hardware Environment</strong></td>
                      <td>{{$spec->hardware_env}}</td>
                  </tr>
                  <tr>
                      <td><strong>Software Environment</strong></td>
                      <td>{{$spec->software_env}}</td>
                  </tr>
                 </table>
               </div>
               <div class="panel-footer">
                 <p class="text-center"><a  href="/specifications/{{$spec->id}}">Show More Details</a></p>
               </div>    
           </div>
          @empty
          <h3 class="text-center">Nom Specifications Available</h3>
         @endforelse
         <p class="text-center">{{$specifications->links()}}</p>
        </div>
    </div>
</div>
@endsection