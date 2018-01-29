@extends('dashboards.admin.appdash')


@section('dash_content')

<br>

<div class="card">
        <div class="card-header">
                <i class="icon-people"></i> Admins
              </div>
<div class="card-body">
        <div class="row">
               
                    <div class="col-md-12 ">
                            <div class="input-group">

                                    <input onkeyup="searchbar()" id="myInput" type="text" id="search" class="form-control" placeholder="Recherche (Par Nom)">
                                    <span class="input-group-btn">
                                            <button id="searchbtn" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                          </span>
                                  </div>
                    </div>
        </div><br>
        <table id="myTable" class="table table-responsive-sm table-hover table-outline mb-0">
                <thead class="thead-light">
                  <tr>
                    <th class="text-center">Name</th>
                     <th class="text-center">Activity</th>
                     <th class="text-center">Phone</th>
                     <th class="text-center">Fax</th>
                     <th class="text-center">Adresse</th>
                     <th class="text-center">Moyenne</th>
                  </tr>
                </thead>
                <tbody>
                   
                        @foreach ($companies as $user) 
                            <tr>
                                

                                <td>
                                        <span>{{$user->name}}</span>
                                </td>

                                <td>
                                        <span>{{$user->activity}}</span>
                                </td>
                                <td>
                                        <span>{{$user->phone}}</span>
                                </td>
                                <td>
                                        <span>{{$user->fax}}</span>
                                </td>
                                <td>
                                        <span>{{$user->address}}</span>
                                </td>
                                <td>
                                        <span>{{ \App\Http\Controllers\GetStat::companystat($user->id)}} </span>
                                </td>
                                        <!-- Edit and Delete Btn -->
                            
                        @endforeach




                </tbody>
              </table>
              <br>
              <div class="row align-items-center justify-content-center">
 
                     <div class="row">
                             <div class="col">
                             
                             </div>
                             <div class="col">
                                 
                             </div>
                             <div class="col">
                            
                             </div>
                           </div>
                         </div>
             

</div>

</div>
<script>
        function searchbar() {
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