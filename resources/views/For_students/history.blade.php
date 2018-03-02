@extends('../layouts/dashboard')

@section("content")
<div class="container">
    <br>
    <div class="row">
        <div class="col-xs-12">
            <h4 class="page-head-line">
                Historiques
            </h4>
        </div>
    </div>

    @if($has_defense == true)
        @foreach($result as $r)
            <div class="history">
                <div class="row page-header">
                    <h3>Stage
                      @if( $r->type == 'init' )
                          <td>Initiation</td>
                      @elseif($r->type == 'perf')
                        <td>Perfectionnment</td>
                      @else
                        <td>PFE</td>
                      @endif
                    </h3>
                </div>
                <div class="row internship">
                    <h4 style="color:#2C3A47">Information sur le stage:</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr style="color:white;background:#58B19F">
                                    @if($r->type != "init")
                                      <th>Encadreur</th>
                                    @endif
                                    <th>Manager</th>
                                    <th>Entreprise</th>
                                    <th>Date de debut</th>
                                    <th>Date de fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if($r->type != "init")
                                        <td>{{ $r->framer_firstname}} {{$r->framer_lastname}} </td>
                                    @endif
                                    <td> {{ $r->manager_name }} </td>
                                    <td> {{ $r->company_name }} </td>
                                    <td> {{ $r->start_date }} </td>
                                    <td> {{ $r->end_date}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><br>
                </div>
                <div class="row defense">
                    <h4 style="color:#2C3A47">Information sur la soutenance:</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr style="color:white;background:#58B19F">
                                    <th>Nom de rapporteur</th>
                                    <th>Nom de president</th>
                                    <th>Salle </th>
                                    <th>Date de soutenance</th>
                                    <th>Date de debut</th>
                                    <th>Date de fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> {{ $r->repo_name}} {{ $r->repo_last }}</td>
                                    <td> {{ $r->pres_name }} {{ $r->pres_last }}</td>
                                    <td> {{ $r->classroom }}</td>
                                    <td> {{ $r->date_d }} </td>
                                    <td> {{ $r->start_time }} </td>
                                    <td> {{ $r->end_time }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><br>
                <div class="row minute">
                    <h4 style="color:#2C3A47">Le resulat de soutenance </h4>
                    @if($r->has_minute == "false")
                        <p class="text-danger">Vous n'avez pas de note sur ce stage! </p>
                    @else
                        <div class="row table-responsive col-md-10 col-xs-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr style="color:white;background:#58B19F">
                                        <th>Note finale</th>
                                        <th>Mention</th>
                                        <th>Les remarques</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $r->final_note }}</td>
                                        <td> {{ $r->mention }} </td>
                                        <td> {{ $r->notes }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if($r->final_note > 10)
                            <div class="col-md-2 col-xs-12">
                                <img src="{{ asset('img/graduate.png') }}" style="width:100px">
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    @else
    <h1>Aucune historique</h1>
    @endif
    <br><br>
</div>
@endsection
