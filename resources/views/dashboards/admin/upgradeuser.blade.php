@extends('dashboards.admin.appdash')


@section('dash_content')
<br>

<div class="card">
<div class="card-header">
        <i class="icon-people"></i> Upgrade Teacher (Promotion)
      </div>
<div class="card-body">
<div class="row">
        <div class="col-md-4">
                  
        </div>
            <div class="col-md-12 ">
                    <div class="input-group">

                            <input type="text" id="search" class="form-control" placeholder="Recherche ( Nom | Prénom | CIN | Email )">
                            <span class="input-group-btn">
                                    <button id="searchbtn" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                  </span>
                          </div>
            </div>
</div><br>
<table class="table table-responsive-sm table-hover table-outline mb-0">
        <thead class="thead-light">
          <tr>
            
            <th>Nom et Prénom</th>
            <th>Email</th>
            <th>Date De Naissance</th>
            <th>Tel</th>
            <th>CIN</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
           
               @foreach($alldata as $mydata)
                    <tr>
                        <td >
                          {{$mydata->firstname}} {{$mydata->lastname}} 
                    </td>

                        <!-- name and date of regestration -->
                    <td>
                        <span>{{$mydata->email}}</span>

                    </td>

                        <!-- email -->
                    <td>
                            <span>{{$mydata->birthdate}}</span>
                    </td>
                        <!-- birthdate -->
                    <td>
                            <span>{{$mydata->phone}}</span>
                     </td>
                       <!-- tel -->
                    <td>
                            <span>{{$mydata->cin}}</span>
                    </td>
                                 <!-- Edit and Delete Btn -->
                     <td>
                                <div class="center">
                                   
                                    &nbsp;&nbsp;
                                    <a href="#" style="text-decoration:none;" onclick="upgradefunc({{$mydata->id}})"  ><i class="icon-arrow-up-circle" style="font-size:25px;color:#27ae60"></i></a>
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

</script>

@endsection