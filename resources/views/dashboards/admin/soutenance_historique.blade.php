@extends('dashboards.admin.appdash')


@section('dash_content')
<br>
    <div class="card">

        <div class="card-header">
                <i class="fa fa-edit"></i> Soutenances Historique
        </div>

<div class="card-body">
        <div class="row"><div class="col-sm-12">
                <div class="row">
                        <div class="col-md-4">
                                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control" id="ccyear">
                                        <option> -- Selectionner La Session</option>
                                       
                                        <option value="/dashboard/soutenances_historique/2010-2011">2010/2011</option>
                                        <option value="/dashboard/soutenances_historique/2011-2012">2011/2012</option>
                                        <option value="/dashboard/soutenances_historique/2012-2013">2012/2013</option>
                                        <option value="/dashboard/soutenances_historique/2013-2014">2013/2014</option>
                                        <option value="/dashboard/soutenances_historique/2014-2015">2014/2015</option>
                                        <option value="/dashboard/soutenances_historique/2015-2016">2015/2016</option>
                                        <option value="/dashboard/soutenances_historique/2016-2017">2016/2017</option>
                                        <option value="/dashboard/soutenances_historique/2017-2018">2017/2018</option>
                                        <option value="/dashboard/soutenances_historique/2018-2019">2018/2019</option>
                                        <option value="/dashboard/soutenances_historique/2019-2020">2019/2020</option>
                                        <option value="/dashboard/soutenances_historique/2020-2021">2020/2021</option>
                                        <option value="/dashboard/soutenances_historique/2021-2022">2021/2022</option>
                                        <option value="/dashboard/soutenances_historique/2022-2023">2022/2023</option>
                                        <option value="/dashboard/soutenances_historique/2023-2024">2023/2024</option>
                                        <option value="/dashboard/soutenances_historique/2024-2025">2024/2025</option>
                                        <option value="/dashboard/soutenances_historique/2025-2026">2025/2026</option>
                                        <option value="/dashboard/soutenances_historique/2026-2027">2026/2027</option>
                                        <option value="/dashboard/soutenances_historique/2027-2028">2027/2028</option>
                                </select>   
                        </div>
                            <div class="col-md-8 ">
                                    <div class="input-group">
        
                                            <input type="text" onkeyup="myFunction()"  id="myInput" class="form-control" placeholder="Rechercher Par Nom...">
                                            <span class="input-group-btn">
                                                    <button id="searchbtn" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                                  </span>
                                          </div>
                            </div>
                </div><br>
            <table id="myTable" class="table table-responsive-sm table-hover table-outline mb-0" role="grid"  style="border-collapse: collapse !important" id="myTable">

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
                                <td><a onclick="openpdf({{$s->userid}})" style="cursor:pointer" ><i class="kk kk-file-acrobat"></i></a></td>
                        </tr>
                    @endforeach  
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

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