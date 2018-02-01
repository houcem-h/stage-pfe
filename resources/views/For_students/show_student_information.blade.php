@extends('../layouts/dashboard')

@section("content")
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Mes informations</h4>
            </div>
        </div>
        <div class="informations col-md-6">
            <div class="col-sm-6"><h4>Nom :</h4> </div>
            <div class="col-sm-6"><h4>{{ $student->firstname}}</h4> </div>
            <div style="border-bottom:1px solid #F0677C;margin-bottom:7px" class="col-xs-12"></div>
            
            <div class="col-sm-6"><h4>Prenom :</h4> </div>
            <div class="col-sm-6"><h4>{{ $student->lastname}}</h4> </div>
            <div style="border-bottom:1px solid #F0677C;margin-bottom:7px" class="col-xs-12"></div>
            
            <div class="col-sm-6"><h4>Adresse email :</h4> </div>
            <div class="col-sm-6"><h4>{{ $student->email}}</h4> </div>
            <div style="border-bottom:1px solid #F0677C;margin-bottom:7px" class="col-xs-12"></div>
            
            <div class="col-sm-6"><h4>Date de naissance :</h4></div>
            <div class="col-sm-6"><h4>{{ $student->birthdate}}</h4> </div>
            <div style="border-bottom:1px solid #F0677C;margin-bottom:7px" class="col-xs-12"></div>
            
            <div class="col-sm-6"><h4>Numero de CIN :</h4></div>
            <div class="col-sm-6"><h4>{{ $student->cin}}</h4> </div>
            <div style="border-bottom:1px solid #F0677C;margin-bottom:7px" class="col-xs-12"></div>
            
            <div class="col-sm-6"><h4>Numero téléphone :</h4></div>
            <div class="col-sm-6"><h4>{{ $student->phone}}</h4> </div>
            <div class="col-xs-12" style="margin-bottom:40px;"></div>
        </div>
        <div class="col-md-5 col-xs-12 col-md-offset-1">
            <div class="col-md-6 col-xs-12 col-md-offset-3">
                <a href="{{ route('edit_profile')}}">
                    <button class="btn btn-primary input-lg">Modifier mes information</button>
                </a>
            </div>
        </div> 
    </div>
</div>
@endsection