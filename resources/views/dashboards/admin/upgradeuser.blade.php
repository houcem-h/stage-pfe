@extends('dashboards.admin.appdash')


@section('dash_content')
<br>

<div class="card">
<div class="card-header">
        <i class="icon-people"></i> Upgrade/Downgrade Teacher (Promotion)
      </div>
<div class="card-body">
<div class="row">
        <div class="col-md-4">
                  
        </div>
            <div class="col-md-12 ">
                    <div class="input-group">

                            <input  onkeyup="myFunction()" type="text" id="myInput" class="form-control" placeholder="Rechercher ...">
                            <span class="input-group-btn">
                                    <button id="searchbtn" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                  </span>
                          </div>
            </div>
</div><br>
<table class="table table-responsive-sm table-hover table-outline mb-0" id="myTable">
        <thead class="thead-light">
          <tr>
            <th>Type</th>
            <th>Nom et Prénom</th>
            <th>Email</th>
            
            <th>Tel</th>
            
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
           
               @foreach($alldata as $mydata)
                    <tr>
                            <td class="text-center">
                                    @if( $mydata->role == 0 )
                                    <span class="badge badge-primary"><i class="icon-user"></i> &nbsp;Student</span>
                                    @endif
                                    @if( $mydata->role == 1 )
                                    <span class="badge badge-danger"><i class="icon-user"></i> &nbsp;Teacher</span>
                                    @endif
                                    @if( $mydata->role == 2 )
                                    <span class="badge badge-warning"><i class="icon-user"></i> &nbsp;Admin</span>
                                    @endif
                            </td>


                        <td >
                          {{$mydata->firstname}} {{$mydata->lastname}} 
                    </td>

                        <!-- name and date of regestration -->
                    <td>
                        <span>{{$mydata->email}}</span>

                    </td>

                        <!-- email -->
                   
                        <!-- birthdate -->
                    <td>
                            <span>{{$mydata->phone}}</span>
                     </td>
                       <!-- tel -->
                    
                                 <!-- Edit and Delete Btn -->
                     <td>
                                <div class="center">
                                        @if( $mydata->role == 1 )
                                    &nbsp;&nbsp;Upgrade &nbsp;
                                    <a href="#" style="text-decoration:none;" onclick="upgradefunc({{$mydata->id}})"  ><i class="icon-arrow-up-circle" style="font-size:25px;color:#27ae60"></i></a>
                                    @endif
                                    @if( $mydata->role == 2 )
                                    &nbsp;&nbsp;Downgrade &nbsp;
                                    <a href="#" style="text-decoration:none;" onclick="downgradefunc({{$mydata->id}})"  ><i class="icon-arrow-down-circle" style="font-size:25px;color:red"></i></a>
                                    @endif
                                </div>
                </td>
            </tr>
            @endforeach



        </tbody>
      </table>

      <br>
      <div class="row align-items-center justify-content-center">

             <div class="row">
                     <div class="col">
                     
                     </div>
                     <div class="col">
                             <div></div>
                     </div>
                     <div class="col">
                    
                     </div>
                   </div>
                 </div>
     

</div>

</div>



<script>

    function upgradefunc(id) {
        swal({
            title: "Are you sure?",
            text: "Do You Want To Upgrade This Teacher To Admin",
            type: "warning",
            showCancelButton: true,
            buttons: true,
            dangerMode: true,
            confirmButtonText: 'Yes, Upgrade!'
          })
          .then((willDelete) => {
            if (willDelete.value) {
                             $.ajaxSetup({
                                    headers: {
                                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              })
                
                              $.ajax({
                                      url: "/upgrade_by_id/" + id
                              });

                             location.reload() ;
                             swal("This User has been Upgraded!", {
                             icon: "success",
                              });

                                

            } else if (willDelete.dismiss === 'cancel') {
              swal("Ok","Operation Canceled", "success");
            }
          });


    }


    function downgradefunc(id) {
        swal({
            title: "Are you sure?",
            text: "Do You Want To Downgrade This User To Normal Teacher",
            type: "warning",
            showCancelButton: true,
            buttons: true,
            dangerMode: true,
            confirmButtonText: 'Yes, Upgrade!'
          })
          .then((willDelete) => {
            if (willDelete.value) {
                             $.ajaxSetup({
                                    headers: {
                                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              })
                
                              $.ajax({
                                      url: "/downgrade_by_id/" + id
                              });

                             location.reload() ;
                             swal("This User has been downgraded!", {
                             icon: "success",
                              });

                                

            } else if (willDelete.dismiss === 'cancel') {
              swal("Ok","Operation Canceled", "success");
            }
          });


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
            td = tr[i].getElementsByTagName("td")[1];
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