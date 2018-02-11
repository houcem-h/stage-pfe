@extends('dashboards.admin.appdash')


@section('dash_content')


<!-- Hidden Moddel -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Modifier L'utilisateur</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                        <!--body-->

                        <div class="row">
                                        <input type="hidden" id="id">
                                        <div class="form-group col-sm-6">
                                          <label for="city">Prénom</label>
                                          <input type="text" class="form-control" id="firstname" >
                                        </div>
                    
                                        <div class="form-group col-sm-6">
                                          <label for="postal-code">Nom</label>
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
                                            <label for="name">Tel</label>
                                            <input type="text" class="form-control" id="phone">
                                          </div>
                    
                                        </div>
                    
                        </div>





                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      <button id="savechanges" type="button" class="btn btn-primary" onclick="updateinfo()">Enregistrer</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
</div>

<br>

<div class="card">
        <div class="card-header">
                <i class="icon-people"></i> Enseignants
              </div>
<div class="card-body">






        <div class="row">
                <div class="col-md-4">
                        <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control" id="ccyear">
                                <option > -- Selectionner Le Type -- </option>
                                <option value="/dashboard/Users/All" >Tous Les Utilisateurs</option>
                                <option value="/dashboard/Users/Students">Étudiants</option>
                                <option value="/dashboard/Users/Teachers">Enseignants</option>
                                <option value="/dashboard/Users/Admins">Admins</option>
                        </select>   
                </div>

                    <div class="col-md-8 ">
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
                    <th class="text-center">Type</th>
                    <th>Nom et Prénom</th>
                    <th>Email</th>
                    <th>Tel</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   
                        @foreach ($allteachers as $user) 
                            <tr>
                                <td class="text-center">
                                    @if( $user->role == 0 )
                                    <span class="badge badge-primary"><i class="icon-user"></i> &nbsp;Student</span>
                                    @endif
                                    @if( $user->role == 1 )
                                    <span class="badge badge-danger"><i class="icon-user"></i> &nbsp;Teacher</span>
                                    @endif
                                    @if( $user->role == 2 )
                                    <span class="badge badge-warning"><i class="icon-user"></i> &nbsp;Admin</span>
                                    @endif
                            </td>

                                <!-- name and date of regestration -->
                            <td>
                                        <div><i class="icon-user"></i>&nbsp; {{$user->firstname}} {{$user->lastname}}</div>
                                        <div class="small text-muted">
                                          <span>Registered: {{$user->created_at}}</span>
                                        </div>

                            </td>

                                <!-- email -->
                            <td>
                                    <span>{{$user->email}}</span>
                            </td>
                           
                               <!-- tel -->
                            <td>
                                    {{$user->phone}}
                            </td>
                                
                                
                               
                                       <!-- Edit and Delete Btn -->
                             <td>
                                        <div class="center">
                                            <a href="#" onclick="deleteuser({{$user->id}})" style="color: red !important;"><i class="icon-trash"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="#"  onclick="modifyinfo({{$user->id}})"><i class="icon-pencil"></i></a>
                                        </div>
                        </td>
                        @endforeach




                </tbody>
              </table>              <br>
              <div class="row align-items-center justify-content-center">
 
                     <div class="row">
                             <div class="col">
                             
                             </div>
                             <div class="col">
                                     <div>{{$allteachers->links()}}</div>
                             </div>
                             <div class="col">
                            
                             </div>
                           </div>
                         </div>
             

</div>

</div>

<script>
                /*********** Ajax Delete User ***************/
        
        
        function deleteuser(id) {
        
        
             
        
        
        
                      swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this User!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                                         $.ajaxSetup({
                                                headers: {
                                                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                          })
                            
                                          $.ajax({
                                                  url: "/deleteuser/" + id
                                          });
        
                                         location.reload() ;
                                         swal("This User has been deleted!", {
                                         icon: "success",
                                          });
        
        
        
                        } else {
                          swal("This User is safe!");
                        }
                      });
        
        
        
        }
        
        </script>
        
        
        
        
        
        <script>
        
        
                /********* Script Recherche Utilisateurs ***********/
                
                    $('#search').on('keypress', function (e) {
                        if(e.which === 13){
                          //Disable textbox to prevent multiple submit
                           $(this).attr("disabled", "disabled");
                
                
                           //Do Stuff, submit, etc..
                
                
                           var query = $('#search').val();
                           if (query.length > 0) {
                                swal({
                                    title: "Loading...",
                                    text: "Please Wait",
                                    icon: 'https://rotoplas.com/rtp_resources/loading.gif'
                                });
                                window.location.href="/dashboard/Users/Search/" + query; 
                           
                            }
                                 else 
                                swal("You Must Write Something ...")
                          
                                
                
                           //Enable the textbox again if needed.
                           $(this).removeAttr("disabled");
                        }
                  });
            
            
                  $("#searchbtn").click(function(){
            
            
                    if ( $('#search').val().length > 0) {
            
                        var query = $('#search').val();
                        swal({
                            title: "Loading...",
                            text: "Please Wait",
                            icon: 'https://rotoplas.com/rtp_resources/loading.gif'
                        });
            
                        window.location.href="/dashboard/Users/Search/" + query; 
                   
                    }
                         else {
                            swal("You Must Write Something ...");
                         }
                        
                  })
            
            /*********** End Script *****************/
                </script>
        
        
        
        
        
        
        
        
        
                <script>
                                /****** Ajax Modify User **********/
                        
        function modifyinfo(id) {
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