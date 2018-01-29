@extends('dashboards.admin.appdash')


@section('dash_content')
<!-- Hidden Moddel -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modify User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              
                <!--body-->

                <div class="row">
                                <input type="hidden" id="id">
                                <div class="form-group col-sm-6">
                                  <label for="city">First Name</label>
                                  <input type="text" class="form-control" id="firstname" >
                                </div>
            
                                <div class="form-group col-sm-6">
                                  <label for="postal-code">Last Name</label>
                                  <input type="text" class="form-control" id="lastname" >
                                </div>
            
                              </div>

                <div class="row">

                                <div class="col-sm-12">
            
                                  <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" class="form-control" id="email">
                                  </div>
            
                                </div>
            
                </div>


                <div class="row">

                                <div class="col-sm-12">
            
                                  <div class="form-group">
                                    <label for="name">CIN</label>
                                    <input type="text" class="form-control" id="cin">
                                  </div>
            
                                </div>
            
                </div>

                <div class="row">

                                <div class="col-sm-12">
            
                                  <div class="form-group">
                                    <label for="name">Phone</label>
                                    <input type="text" class="form-control" id="phone">
                                  </div>
            
                                </div>
            
                </div>





            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button id="savechanges" type="button" class="btn btn-primary" onclick="updateinfo()">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>



<br>
<h1> Waiting List</h1>
<input id="search_byname" type="text" class="form-control" placeholder="Search By Name" onkeyup="search_table_by_name()"></input>
<br>
<button id="accept_all_selection" onClick="AcceptAllSelectedUsers();" class="btn btn-success">Accept All Selected Users</button> 
<button id="refuse_all_selection" onClick="RejectAllSelectedUsers();" class="btn btn-danger">Reject All Selected Users</button> 

<br><br>
<table id="tableOne" class="table table-responsive-sm table-hover table-outline mb-0">

        <thead>
            <tr>                        
                <th>Select All : <input type="checkbox" /></th>
                <th>Nom et Prénom</th>
                <th>Email</th>
                <th>CIN</th>
                <th>Tel</th>
                <th>Date De Naissance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Allwaiting as $user)
            <tr>                                
                <td class="chk"><input type="checkbox" /></td>
                    <td id="userid" userid="{{$user->id}}"><strong>{{$user->firstname}} {{$user->lastname}} </strong></td>
                    <td id="email">{{$user->email}}</td>
                    <td>{{$user->cin}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->birthdate}}</td>
                    <td>
                            <div class="center">
                                <a href="#"  onclick="AcceptUser({{$user->id}})" style="color: green !important;"><i class="fa fa-check"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="#" onclick="Modifyinfo({{$user->id}})" ><i class="fa fa-edit"></i></a>
                                    &nbsp;&nbsp;
                                <a href="#" onclick="RejectUser({{$user->id}})" style="color: red !important;"><i class="fa fa-times"></i></a>
                               
                            </div>
            </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>


    <script>
            //to check all
                $("#tableOne thead tr th:first input:checkbox").click(function () {
                    var checkedStatus = this.checked;
                    $("#tableOne tbody tr td:first-child input:checkbox").each(function () {
                        this.checked = checkedStatus;
                    });
                });



                //check by clicking on row
                $('td:not(.chk)').click( function() {
                    $(this).parent().find("td:first-child").html('<input type="checkbox" checked>');
              });


                //search table
                function search_table_by_name(){
                    var input, filter, table, tr, td, i;
                    input = document.getElementById("search_byname");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("tableOne");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1]; //td name
                        if (td) {
                                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                }
                                else {
                                    tr[i].style.display = "none";
                                }
                        }       
                    }
                }


                //Ajax Setup (Important !)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })




                // Change User State To Accepted
                function AcceptUser(id) {
                    $.ajax({
                        url: "/AcceptUser/" + id,
                        beforeSend: function() {
                            swal({
                                title: "Loading...",
                                text: "Please Wait",
                                icon: 'https://rotoplas.com/rtp_resources/loading.gif'
                              });
                         },
                         complete: function() {
                           // $('#general-ajax-load ').fadeOut();
                         },
                        success: function(resp)
                        {
                            swal("Done!", "All Selected Users Accepted successfully", "success");
                            location.reload();                         
                        },
                        error: function(resp) {
                            swal("Error", "Error : " + "There was an error ..." , "error");
                            console.log( resp);
                        }
                      });
                }

                // Change User State To Rejected
                function RejectUser(id) {
                    $.ajax({
                        url: "/RejectUser/" + id,
                        beforeSend: function() {
                            swal({
                                title: "Loading...",
                                text: "Please Wait",
                                icon: 'https://rotoplas.com/rtp_resources/loading.gif'
                              });
                         },
                         complete: function() {
                           // $('#general-ajax-load ').fadeOut();
                         },
                        success: function(resp)
                        {
                            swal("Done!", "All Selected Users Accepted successfully", "success");
                            location.reload();                         
                        },
                        error: function(resp) {
                            swal("Error", "Error : " + "There was an error ..." , "error");
                            console.log( resp);
                        }
                      });
                }

                // Modify User Info
                function Modifyinfo(id) {
                    var firstname = '';
                    var lastname = '';
                    var email = '';
                    var cin = '';
                    var phone = '';
                    $.getJSON('/getuserinfo/' + id, function(data) {
                            firstname = data.firstname;
                            lastname = data.lastname;
                            email = data.email;
                            cin = data.cin;
                            phone = data.phone;
                    }).done(function(){
            
                            $('#largeModal').modal('toggle');
                            $("#firstname").val(firstname);
                            $("#lastname").val(lastname);
                            $("#email").val(email);
                            $("#cin").val(cin);
                            $("#phone").val(phone);
                            $("#id").val(id);
                    });
                }

                // Accept All Selected Users (Button)
                function AcceptAllSelectedUsers() {
                    var checkedValues = $('input:checkbox:checked').map(function() {
                        return $(this).parent().parent().find('#userid').attr('userid');
                    }).get();

                    $.ajax({
                        type: "POST",
                        url: "/AcceptUsers",
                        data: { ids : JSON.stringify(checkedValues) },
                        beforeSend: function() {
                            swal({
                                title: "Loading...",
                                text: "Please Wait",
                                icon: 'https://rotoplas.com/rtp_resources/loading.gif'
                              });
                         },
                         complete: function() {
                           // $('#general-ajax-load ').fadeOut();
                         },
                        success: function(resp)
                        {
                            swal("Done!", "All Selected Users Accepted successfully", "success");
                            location.reload();                         
                        },
                        error: function(resp) {
                            swal("Error", "Error : " + "There was an error ..." , "error");
                            console.log( resp);
                        }
                      });



                    return checkedValues;
                }

                // Reject All Selected Users (Buttton)
                function RejectAllSelectedUsers() {
                    var checkedValues = $('input:checkbox:checked').map(function() {
                        return $(this).parent().parent().find('#userid').attr('userid');
                    }).get();

                    $.ajax({
                        type: "POST",
                        url: "/RejectUsers",
                        data: { ids : JSON.stringify(checkedValues) },
                        beforeSend: function() {
                            swal({
                                title: "Loading...",
                                text: "Please Wait",
                                icon: 'https://rotoplas.com/rtp_resources/loading.gif'
                              });
                         },
                         complete: function() {
                               
                         },
                        success: function(resp)
                        {
                            swal("Done!", "All Selected Users Accepted successfully", "success");
                            location.reload();                         
                        },
                        error: function(resp) {
                            swal("Error", "Error : " + "There was an error ..." , "error");
                            console.log( resp);
                        }
                      });



                    return checkedValues;    
                }

                //Update info (in modal) 
                function updateinfo() {
                    $("#savechanges").click(function(){
                        $.ajaxSetup({
                                headers: {
                                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                          })
                        var id = $("#id").val();
                        var firstname = $("#firstname").val();
                        var lastname = $("#lastname").val();
                        var email = $("#email").val();
                        var cin = $("#cin").val();
                        var phone = $("#phone").val();
                        $.ajax({
                                type: "POST",
                                url: "/updateuser",
                                data: "id=" + id + "&firstname=" + firstname +"&lastname="+ lastname + "&cin=" + cin + "&phone="+phone + "&email=" +email
                        }).done(function(){
                                swal("Updated!", "User Info Updated!", "success");
                                
                                location.reload();
                        });
                       
                            
                      });
                }

    </script>

@endsection