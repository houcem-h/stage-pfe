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
                <a href="{{URL('/internshipdemand?t='.Session::get('t'))}}">
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
        @if(!empty($InternshipResult))
        <div class="col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="page-head-line">Activité en cours</h5>
                </div>
            </div>
            <div class="activite">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type de stage</th>
                            @if( $InternshipResult[0]->type != 'init')
                              <th>Encadreur</th>
                            @endif
                            <th>Manager</th>
                            <th>Entreprise</th>
                            <th>Date de debut</th>
                            <th>Date de fin</th>
                            <th>Statu de stage</th>
                            <th>Modifier la demande</th>
                        </tr>
                    </thead>
                    <tr>
                        @if( $InternshipResult[0]->type == 'init' )
                            <td>Initiation</td>
                        @elseif($InternshipResult[0]->type == 'perf')
                          <td>Perfectionnment</td>
                        @else
                          <td>PFE</td>
                        @endif
                        @if( $InternshipResult[0]->type != 'init')
                            <td>{{ $InternshipResult[0]->firstname." ".$InternshipResult[0]->lastname }}</td>
                        @endif
                        <td>{{ $InternshipResult[0]->name }}</td>
                        <td>{{ $InternshipResult[0]->company_name }}</td>
                        <td>{{ $InternshipResult[0]->start_date }}</td>
                        <td>{{ $InternshipResult[0]->end_date }}</td>
                        @if($InternshipResult[0]->state == "waiting")
                            <td><span class="label label-default customLabel">{{ $InternshipResult[0]->state }}</span></td>
                            <td style="text-align:center">
                                <a href="">
                                    <i class="fa fa-pencil fa-fw" aria-hidden="true" style="font-size:x-large;"></i>
                                </a>
                            </td>
                        @elseif($InternshipResult[0]->state == "accepted")
                            <td><span class="label label-success customLabel">{{ $InternshipResult[0]->state }}</span></td>
                            <td style="text-align:center">
                                <i class="fa fa-ban fa-fw" aria-hidden="true" style="font-size:x-large;"></i>
                            </td>
                        @else
                            <td><span class="label label-danger customLabel">{{ $InternshipResult[0]->state }}</span></td>
                            <td style="text-align:center">
                                <i class="fa fa-ban fa-fw" aria-hidden="true" style="font-size:x-large;"></i>
                            </td>
                         @endif
                    </tr>

                </table>
            </div>
        </div>
        @endif

        @if(!empty($InternshipResult) && $AcceptedDefense == true)
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Soutenance</h4>
                </div>
            </div>

            @if($DefenseInfo != null)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Type de stage</th>
                        <th>Nom de rapporteur</th>
                        <th>Nom de president</th>
                        <th>Salle </th>
                        <th>Date de soutenance</th>
                        <th>Date de debut</th>
                        <th>Date de fin</th>
                    </tr>
                </thead>
                <tr>
                    @if( $DefenseInfo->type == 'init' )
                        <td>Initiation</td>
                    @elseif($DefenseInfo->type == 'perf')
                      <td>Perfectionnment</td>
                    @else
                      <td>PFE</td>
                    @endif
                    <td>{{ $DefenseInfo->repo_name}} {{ $DefenseInfo->repo_last }}</td>
                    <td>{{ $DefenseInfo->pres_name}} {{ $DefenseInfo->pres_last }}</td>
                    <td>{{ $DefenseInfo->classroom }}</td>
                    <td>{{ $DefenseInfo->date_d }}</td>
                    <td>{{ $DefenseInfo->start_time }}</td>
                    <td>{{ $DefenseInfo->end_time }}</td>
                </tr>
            </table>
            @else
                <h4>Aucune soutenance programmée pour le moment</h4>
                <p>Nous vous envoyerons un email quand elle est prete, ou visiter votre profile pour voir la date de soutenance</p>
            @endif

        @endif


        @if($DateDefensePassed == true && !empty($InternshipResult) && $AcceptedDefense == true)
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Resultat de soutenance</h4>
                </div>
            </div>
            @if($minuteInfo != null)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Type de stage </th>
                        <th>Note finale</th>
                        <th>Mention</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                         @if( $minuteInfo[0]->type == 'init' )
                             <td>Initiation</td>
                         @elseif($minuteInfo[0]->type == 'perf')
                           <td>Perfectionnment</td>
                         @else
                           <td>PFE</td>
                         @endif
                         <td>{{ $minuteInfo[0]->final_note }}</td>
                         <td>{{ $minuteInfo[0]->mention }}</td>
                         <td>{{ $minuteInfo[0]->notes }}</td>
                     </tr>
                </tbody>
            </table>
            @else
                <h4>Les resulats ne sont pas encore prete ..!! </h4>
                <p>Nous vous envoyerons un mail lorsque elle est pretes</p>
            @endif
        @endif
    </div>
</div>
@endsection
