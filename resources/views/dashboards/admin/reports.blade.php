@extends('dashboards.admin.appdash')


@section('dash_content')
<br>



<div class="card">
        <div class="card-header">
                <i class="icon-people"></i> Download Reports 
              </div>
    <div class="card-body">

        <div class="center-block">
               <center> <h2> Download Reports </h2>
                <br><br>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                            <h3>Étudiants</h3><br>
                            <h1><i class="kk kk-file-acrobat"></i></h1>
                            
                            <a class="btn btn-danger" href="{{ route('studentspdf') }}">Liste Des Étudiants (PDF)</a>
                            <br> <br><br>
                            <h1><i class="kk kk-file-excel"></i></h1>
                            <a class="btn btn-success" href="{{ route('studentsxls') }}">Liste Des Étudiants (Excel)</a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                            <h3>Enseignants </h3><br>
                            <h1><i class="kk kk-file-acrobat"></i></h1>
                            
                            <a class="btn btn-danger" href="{{ route('teacherspdf') }}">Liste Des Enseignants (PDF)</a>
                            <br> <br><br>
                            <h1><i class="kk kk-file-excel"></i></h1>
                            <a class="btn btn-success" href="{{ route('teachersxls') }}">Liste Des Enseignants (Excel)</a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                            <h3>Soutenances</h3><br>
                            <h1><i class="kk kk-file-acrobat"></i></h1>
                            
                            <a class="btn btn-danger" href="#">Under Construction</a>
                            <br> <br><br>
                            <h1><i class="kk kk-file-excel"></i></h1>
                            <a class="btn btn-success" href="#">Under Construction</a>
                    </div>







                </div>



          
    
    
    
    
        </center>
        </div>


    </div>
</div>



@endsection