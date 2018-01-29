@extends('dashboards.admin.appdash')


@section('dash_content')
<br>
    <div class="card">

        <div class="card-header">
                <i class="fa fa-edit"></i> Interships (All)
        </div>

<div class="card-body">
        <div class="row"><div class="col-sm-12">
                <input onkeyup="myFunction()"  class="form-control" type="text" placeholder="Search By Name..." id="myInput"><br>
                <table class="table table-responsive-sm table-hover table-outline mb-0" role="grid"  style="border-collapse: collapse !important" id="myTable">

                        <thead class="thead-light">
                                <tr>
                                  <th class="text-center">Full Name</th>
                                  <th class="text-center">Start Date</th>
                                  <th class="text-center">End Date</th>
                                  <th class="text-center">Type</th>
                                  <th class="text-center">Framer</th>
                                  <th class="text-center">Comapny Framer</th>
                                  <th class="text-center">Status</th>
                                </tr>
                              </thead>
    
                    <tbody>
                        @foreach ( $alldata as $s )
                            <tr role="row" class="odd">
                                    <td class="text-center">{{$s->firstname}} {{$s->lastname}}</td>
                                    <td  class="text-center">{{$s->start_date}}</td>
                                    <td class="text-center">{{$s->end_date}}</td>
                                    <td class="text-center">{{$s->type}}</td>
                                    <td class="text-center">{{\App\Http\Controllers\GetStat::get_teacher_fullname( $s->framer ) }}</td>
                                    <td class="text-center">{{$s->name}}</td>
                                    <td class="text-center">
                                        
                                        <span class="badge badge-success">{{$s->state}}</span>
                                        
                                       
                                    </td>
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

@endsection