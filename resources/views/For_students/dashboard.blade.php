@extends('../layouts/dashboard')

@section("content")
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Tableau de bord</h4>
            </div>
        </div>
        <div class="row">
            <a href="{{ route('display_informations') }}">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="dashboard-div-wrapper bk-clr-three">
                        <i  class="fa fa-info-circle dashboard-div-icon" ></i>
                        <h5>Mes informations </h5>
                    </div>
                </div>
            </a>
            @if(Session::has("t"))
                <a href="{{ url('student/demande?t='.Session::get('t')) }}">
            @else
                <a href="{{ route('demande_stage') }}">
            @endif
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="dashboard-div-wrapper bk-clr-two">
                        <i  class="fa fa-paper-plane-o dashboard-div-icon" ></i>
                        <h5>Demande d'un stage </h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('history')}}">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="dashboard-div-wrapper" style="background-color:#2980b9">
                        <i  class="fa fa-history dashboard-div-icon" ></i>
                        <h5>Historiques </h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('Notification') }}">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="dashboard-div-wrapper bk-clr-four notification">
                        <i  class="fa fa-bell dashboard-div-icon" ></i>
                        <h5>Notifications </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="page-head-line">Activité en cours</h5>
                </div>
            </div>
            <div class="activite">
                @if(count($check_demandes) > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Type de stage</th>
                                <th>Encadreur</th>
                                <th>Manager</th>
                                <th>Entreprise</th>
                                <th>Date de debut</th>
                                <th>Date de fin</th>
                                <th>Statu de stage</th>
                                <th>Modifier la demande</th>
                            </tr>
                        </thead>
                        @foreach($check_demandes as $check)
                            <tr>
                                <td>{{ $check->type }}</td>
                                <td>{{ $check->firstname." ".$check->lastname }}</td>
                                <td>{{ $check->name }}</td>
                                <td>{{ $check->company_name }}</td>
                                <td>{{ $check->start_date }}</td>
                                <td>{{ $check->end_date }}</td>
                                    @if($check->state == "waiting")
                                        <td><span class="label label-default customLabel">{{ $check->state }}</span></td>
                                        <td style="text-align:center">
                                            <a href="">
                                                <i class="fa fa-pencil fa-fw" aria-hidden="true" style="font-size:x-large;"></i>
                                            </a>
                                        </td>
                                    @elseif($check->state == "accepted")
                                        <td><span class="label label-success customLabel">{{ $check->state }}</span></td>
                                        <td style="text-align:center">
                                            <i class="fa fa-ban fa-fw" aria-hidden="true" style="font-size:x-large;"></i>
                                        </td>
                                    @else
                                        <td><span class="label label-danger customLabel">{{ $check->state }}</span></td>
                                        <td style="text-align:center">
                                            <i class="fa fa-ban fa-fw" aria-hidden="true" style="font-size:x-large;"></i>
                                        </td>
                                    @endif
                            </tr>
                        @endforeach
                    </table>
                @else 
                    <h3>Aucune activitée</h3>
                @endif
            </div>
            @if($defense == "no soutenance")
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Soutenance</h4>
                </div>
            </div>
            <h4>Aucune soutenance programmée pour le moment</h4>
            <p>Nous vous envoyerons un email quand elle est prete, ou visiter votre profile pour voir la date de soutenance</p>
            @elseif(sizeof($defense) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line">Soutenance</h4>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Type de stage</th>
                            <th>Nom de rapporteur</th>
                            <th>Nom de president</th>
                            <th>Salle </th>
                            <th>Date de soutenance</th>
                            <th>Date de debut</th>
                            <th>Date de fin</th>
                        </tr>
                    </thead>
                    @foreach($defense as $key => $def)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $def->type }}</td>
                            <td>{{ $def->repo_name}} {{ $def->repo_last }}</td>
                            <td>{{ $def->pres_name}} {{ $def->pres_last }}</td>
                            <td>{{ $def->classroom }}</td>
                            <td>{{ $def->date_d }}</td>
                            <td>{{ $def->start_time }}</td>
                            <td>{{ $def->end_time }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        
    </div>
</div>
@endsection
