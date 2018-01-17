@extends('layouts.app')
@section('content')
<div class="jumbotron" id="jumbotronstudentdashboard" style="margin-top:0px;">
    <h1 class="text-center">
        Student Dashboard<BR><BR>

    </h1>
            @if(auth()->user()->LegalIntershipsTypes)
            Interships types available to this Student
                @foreach(auth()->user()->LegalIntershipsTypes as $type)
                <strong>{{$type}}</strong><br>
                @endforeach
            @endif
    <div id="fillbottomjumbotron">
        <a href="{{URL('/company/create')}}" class="btn btn-default">Fill Intership Form</a>
    </div>
    
</div>

<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="row">
            @if(session('success'))
               {{session('success')}}
            @endif
        </div>
    </div>
</div>
@endsection