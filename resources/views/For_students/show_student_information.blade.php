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
        {{--  <div class="group_registre col-md-5 col-sm-12 col-md-offset-1">
            @if($group_found != false)
                <h4>*Vous ete inscrit dans le groupe {{ $group }}</h4> 
                <h4>*Session {{ $session }}</h4>
            @else
                <h4>Vous n'etes pas inscri cette année universitaire</h4>
            @endif
        </div>  --}}
    </div>
</div>
@endsection