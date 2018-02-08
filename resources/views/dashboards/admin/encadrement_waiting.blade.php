@extends('dashboards.admin.appdash')


@section('dash_content')


<!-- Hidden Moddel -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              
                <!--body-->
                <table class="table table-responsive-sm table-hover mb-0">
                        <tr>
                            <td>
                                    <h5>Nom et Prénom Enseignant : </h5>
                            </td>
                            <td>
                                    <span id="nom_teacher"></span>
                            </td>
                        </tr>
                        <tr>
                                <td>
                                        <h5>Nom et Prénom Etudiant : </h5>
                                </td>
                                <td>
                                        <span id="nom_std"></span>
                                </td>
                            </tr>
                        <tr>
                                <td>
                                        <h5>Titre: </h5>
                                </td>
                                <td>
                                        
                                        <span id="titre"></span>
                                </td>
                            </tr>
 
                            <tr>
                                    <td>
                                            <h5>Type Du Projet: </h5>
                                    </td>
                                    <td>
                                          
                                            <span id="type_projet"></span>
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                        <td>
                                                <h5>Description Du Projet: </h5>
                                        </td>
                                        <td>
                                                
                                                <span id="descrip"></span>
                                        </td>
                                    </tr>


                                    <tr>
                                            <td>
                                                    <h5>Besoin: </h5>
                                            </td>
                                            <td>
                                                    
                       
                        <span id="besoin"></span>
                                            </td>
                                        </tr>


                                        <tr>
                                                <td>
                                                        <h5>Environnement Materiel: </h5>
                                                </td>
                                                <td>
                                                        
                 
                        <span id="env_mat"></span>
                                                </td>
                                            </tr>


                                            <tr>
                                                    <td>
                                                            <h5>Environnement Logiciel: </h5>
                                                    </td>
                                                    <td>
                                                            
                                                            <span id="env_log"></span>
                                                    </td>
                                                </tr>

                                            

                                                    <tr>
                                                            <td>
                                                                    <h5>Programmation Provisoire: </h5>
                                                            </td>
                                                            <td>
                                                                 
                     
                        <span id="prog_prov"></span> 

                                                            </td>
                                                        </tr>


                            

                </table>
                        
                      
                        
                      
                       
                      



            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<!--end modal-->





<br>
    <div class="card">

        <div class="card-header">
                <i class="fa fa-edit"></i> Demandes D'Encadrements Par Enseignant (En Attente)
        </div>

<div class="card-body">
        <div class="row"><div class="col-sm-12">
            <input onkeyup="myFunction()"  class="form-control" type="text" placeholder="Search By Name..." id="myInput"><br>
            <table class="table table-responsive-sm table-hover table-outline mb-0" role="grid"  style="border-collapse: collapse !important" id="myTable">

                    <thead class="thead-light">
                            <tr>
                                    <th class="text-center">Statut</th>
                              <th class="text-center">Nom D'enseignant</th>
                              <th class="text-center">Nom D'etudiant</th>
                              <th class="text-center">Titre</th>
                                <th class="text-center">Plus D'Info</th>
                                <th class="text-center">Action</th>
                            
                         
                            </tr>
                          </thead>

                <tbody>
                @foreach($alldata as $data)
                        <tr role="row" class="odd">
                                <td class="text-center">
                                   @if ($data->status == "accepeted")
                                     <span class="badge badge-success"><i class="icon-user"></i> &nbsp;Accepté</span> 
                                    @elseif ($data->status == "waiting")
                                    <span class="badge badge-warning"><i class="icon-user"></i> &nbsp;En Attente</span> 
                                    @elseif ($data->status == "rejected")
                                    <span class="badge badge-danger"><i class="icon-user"></i> &nbsp;Rejeté</span> 
                                    @endif
                                </td>
                                <td class="text-center">{{$data->teacher_firstname}} {{$data->teacher_lastname}}</td>
                                <td  class="text-center">{{$data->student_firstname}} {{$data->student_lastname}}</td>
                                <td class="text-center">{{$data->title}}</td>  
                                <td class="text-center"> 
                                    &nbsp;&nbsp;
                                    <a href="#" style="text-decoration:none;" onclick='getinfo({{$data->id}})'><i class="fa fa-folder-open-o" style="font-size:25px;color:blue"></i></a>
                                </td>

                                <td  class="text-center">
                                        &nbsp;&nbsp;Accepter : 
                                        <a href="#" style="text-decoration:none;"  onclick='accept({{$data->id}})'><i class="fa fa-check" style="font-size:25px;color:#27ae60"></i></a>
                                        &nbsp;&nbsp;Refuser :
                                        <a href="#" style="text-decoration:none;" onclick='reject({{$data->id}})'><i class="fa fa-close" style="font-size:25px;color:red"></i></a>
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




<script>
    function getinfo(id) {
        var fullname_prof = '';
        var fullname_etudiant = '';
        var projet_titre = '';
        var projet_type = '';
        var projet_desc = '';
        var projet_req = "";
        var projet_hard = "";
        var projet_soft = "";
        var projet_provis = "";
        $.getJSON('/frame_req/' + id, function(data) {
            
            fullname_prof = data[0].teacher_firstname + " " + data[0].teacher_lastname;
            fullname_etudiant = data[0].student_firstname + " " + data[0].student_lastname;
            projet_titre = data[0].title;
            projet_type = data[0].project_type;
            projet_desc = data[0].existing_desc;
            projet_req = data[0].requirement_spec;
            projet_hard = data[0].hardware_env;
            projet_soft = data[0].software_env;
            projet_provis = data[0].provisional_planning;
            

                //console.log(data);
        }).done(function(){

                $('#largeModal').modal('toggle');
                $('#nom_teacher').text(fullname_prof);
                $('#nom_std').text(fullname_etudiant);
                $('#titre').text(projet_titre);
                $('#type_projet').text(projet_type);
                $('#descrip').text(projet_desc);
                $('#besoin').text(projet_req);
                $('#env_mat').text(projet_hard);
                $('#env_log').text(projet_soft);
                $('#prog_prov').text(projet_provis);




         
        });

    }

</script>



<script>
        function accept(id) {
                $.ajaxSetup({
                        headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                  })
    
                  $.ajax({
                          url: "/frame_accept/" + id
                  });

                
                 swal("Encadrement Accepté", "Done", "success");
                  location.reload() ;

        }

        function reject(id) {
                $.ajaxSetup({
                        headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                  })
    
                  $.ajax({
                          url: "/frame_reject/" + id
                  });

                
                 swal("Encadrement Refusé", "Done", "success");
                  location.reload() ;

        }

        function waiting(id) {
                $.ajaxSetup({
                        headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                  })
    
                  $.ajax({
                          url: "/frame_waiting/" + id
                  });

                
                 swal("Encadrement En Attente", "Done", "success");
                  location.reload() ;

        }
</script>
@endsection