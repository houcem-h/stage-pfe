@extends('layouts.app')
@section('content')

<div class="col-md-6 col-md-offset-3">
    <div class="jumbotron">
        <h2 class="text-center" style="color:black;">Admin Dashboard </h2><BR><HR>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <p class="text-center" >
                <a href="/company" style="margin-right:30px;">
                    List of Companies 
                </a>
                <a href="/internships" style="margin-right:30px;">
                   List Of Interships 
                </a>

                <a href="/companiesmanagers" >
                    List of Companies Managers
                </a>
            </p>
           </div>
        </div>
    </div>
</div>
@endsection
  
