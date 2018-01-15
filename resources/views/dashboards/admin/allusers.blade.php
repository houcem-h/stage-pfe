@extends('dashboards.admin.appdash')


@section('dash_content')

<br>


<div class="card">
        <div class="card-header">
                <i class="icon-people"></i> All Users
              </div>
<div class="card-body">

        <table class="table table-responsive-sm table-hover table-outline mb-0">
                <thead class="thead-light">
                  <tr>
                    <th class="text-center">Type</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Phone</th>
                    <th>CIN</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   
                        <tr>
                                <!-- type -->
                                <td class="text-center">
                                        <span class="badge badge-primary"><i class="icon-user"></i> &nbsp;Student</span>
                                        <span class="badge badge-success"><i class="icon-badge"></i> &nbsp;Verified</span>
                                </td>

                                <!-- name and date of regestration -->
                                <td>
                                  <div><i class="icon-user"></i>&nbsp; Adem Kouki</div>
                                  <div class="small text-muted">
                                    <span>Registered: Jan 1, 2017</span>
                                  </div>
                                </td>

                                <!-- email -->
                                <td>
                                    <span>test@gmail.com</span>
                                </td>

                                <!-- birthdate -->
                                <td>
                                    29-06-1996
                                </td>

                                <!-- tel -->
                                <td>
                                    23456789
                                </td>


                                <!-- cin -->
                                <td>
                                  11393103
                                </td>


                                    <!-- Edit and Delete Btn -->
                                <td>
                                    <div class="center">
                                        <a href="#" style="color: red !important;"><i class="icon-trash"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="#" ><i class="icon-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>



                            <!--- second row example -->

                            <tr>
                                    <!-- type -->
                                    <td class="text-center">
                                            <span class="badge badge-danger"><i class="icon-user"></i> &nbsp;Teacher</span>
                                            <span class="badge badge-success"><i class="icon-badge"></i> &nbsp;Verified</span>
                                    </td>
    
                                    <!-- name and date of regestration -->
                                    <td>
                                      <div><i class="icon-user"></i>&nbsp; Houcem Hedhli</div>
                                      <div class="small text-muted">
                                        <span>Registered: Jan 1, 2017</span>
                                      </div>
                                    </td>
    
                                    <!-- email -->
                                    <td>
                                        <span>test@gmail.com</span>
                                    </td>
    
                                    <!-- birthdate -->
                                    <td>
                                        29-06-1996
                                    </td>
    
                                    <!-- tel -->
                                    <td>
                                        20018628
                                    </td>
    
    
                                    <!-- cin -->
                                    <td>
                                      11111111
                                    </td>
    
    
                                        <!-- Edit and Delete Btn -->
                                    <td>
                                        <div class="center">
                                            <a href="#" style="color: red !important;"><i class="icon-trash"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="#" ><i class="icon-pencil"></i></a>
                                        </div>
                                    </td>
                                </tr>
                        
                               
                                


                           <!--- third row example -->

                           <tr>
                                <!-- type -->
                                <td class="text-center">
                                        <span class="badge badge-warning"><i class="icon-user"></i> &nbsp;Admin</span>
                                        <span class="badge badge-success"><i class="icon-badge"></i> &nbsp;Verified</span>
                                </td>

                                <!-- name and date of regestration -->
                                <td>
                                  <div><i class="icon-user"></i>&nbsp; Admin Ben Admin</div>
                                  <div class="small text-muted">
                                    <span>Registered: Jan 1, 2017</span>
                                  </div>
                                </td>

                                <!-- email -->
                                <td>
                                    <span>test@gmail.com</span>
                                </td>

                                <!-- birthdate -->
                                <td>
                                    29-06-1996
                                </td>

                                <!-- tel -->
                                <td>
                                    20018628
                                </td>


                                <!-- cin -->
                                <td>
                                  11111111
                                </td>


                                    <!-- Edit and Delete Btn -->
                                <td>
                                    <div class="center">
                                        <a href="#" style="color: red !important;"><i class="icon-trash"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="#" ><i class="icon-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>


                </tbody>
              </table>


</div>

</div>

@endsection