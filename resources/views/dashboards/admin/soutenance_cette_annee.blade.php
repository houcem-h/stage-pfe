@extends('dashboards.admin.appdash')


@section('dash_content')
<br>
    <div class="card">

        <div class="card-header">
                <i class="fa fa-edit"></i> Soutenances Cette Année {{ \App\Http\Controllers\GetStat::thisYearSession()}}
        </div>

<div class="card-body">
        <div class="row"><div class="col-sm-12">
            <input onkeyup="myFunction()"  class="form-control" type="text" placeholder="Search By Name..." id="myInput"><br>
            <table class="table table-responsive-sm table-hover table-outline mb-0" role="grid"  style="border-collapse: collapse !important" id="myTable">

                    <thead class="thead-light">
                            <tr>
                              <th class="text-center">Nom Et Prénom</th>
                              <th class="text-center">Session</th>
                              <th class="text-center">Classe</th>
                              <th class="text-center">Date - Temps</th>
                              <th class="text-center">Salle</th>
                              <th class="text-center">Rapporteur</th>
                              <th class="text-center">Président</th>
                              <th class="text-center">Framer</th>
                              <th class="text-center">State</th>
                              <th class="text-center">PDF</th>
                            </tr>
                          </thead>

                          <tbody>
                                @foreach ( $alldata as $s )
                                    <tr role="row" class="odd">
                                            <td class="text-center">{{$s->firstname}} {{$s->lastname}}</td>
                                            <td  class="text-center">{{$s->session}}</td>
                                            <td class="text-center">{{$s->name}}</td>
                                            <td class="text-center">{{$s->date_d}} - {{$s->start_time}}</td>
                                            <td class="text-center">{{$s->classroom }}</td>
                                            <td class="text-center">{{\App\Http\Controllers\GetStat::get_teacher_fullname( $s->reporter ) }}</td>
                                            <td class="text-center">{{\App\Http\Controllers\GetStat::get_teacher_fullname( $s->president ) }}</td>
                                            <td class="text-center">{{\App\Http\Controllers\GetStat::get_teacher_fullname( $s->framer ) }}</td>
                                           <td class="text-center">
                                                @if ($s->state == "accepted")
                                                <span class="badge badge-success">Accepté</span>
                                                @elseif  ($s->state == "waiting")
                                                <span class="badge badge-warning">En Attente</span>
                                                @elseif  ($s->state == "rejected")
                                                <span class="badge badge-danger">Rejeté</span>
                                              @endif
                                            </td>
                                            <td><a onclick="openpdf({{$s->userid}})" style="cursor:pointer"><i class="kk kk-file-acrobat"></i></a></td>
                                    </tr>
                                @endforeach  
                            </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
<script>
        function openpdf(id) {
            window.location = "/dashboard/pdf/soutenance/" + id ;
        }
    </script>
<script>
        function myFunction() {
          var input, filter, table, tr, td, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
        </script>
@endsection