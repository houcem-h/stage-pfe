@extends('dashboards.admin.appdash')
@section('dash_content')
     <h2 class="text-center" style="margin-bottom:55px;margin-top:50px;color:black;">Planning PFE Internships</h2>
<div class="container-fluid">
        <div class="jumbotron col-md-6 col-md-offset-3" style="margin-top:50px;">
            <div class="row">
                <h3 class="text-center" style="color:black;margin-bottom:40px;">Planning Has Been Already Done By  
                    @if(isset($done) && $done->id==auth()->user()->id)
                      You
                    @else
                      Mr {{$done->firstname}} {{$done->lastname}}
                    @endif
                </h3><br><br>
            </div>
            <div class="row">
                <div class="col-md-4">
                  <center><a href="{{URL('/planning/3')}}" class="btn btn-success">Preview</a></center>
                </div>
               {{--  <div class="col-md-4"> 
                  <center><a href="/planning/{{Request::instance()->get('l')}}/edit" class="btn btn-primary">Update</a></center>
               </div>  --}}
               <div class="col-md-4">
                   <center>{!!Form::open(['method'=>"POST","action"=>["PlanningController@destroy",3]])!!}
                     {{Form::hidden('_method','DELETE')}}
                     {{Form::submit('Delete',['class'=>"btn btn-danger",'style'=>"margin-bottom:30px;"])}}
                   {!!Form::close()!!}</center>
               </div>
            </div>
@endsection