@extends('dashboards.admin.appdash')


@section('dash_content')
<br>

<div class="row">

    <!-- All users -->
    <div id="1" class="col-sm-6 col-md-2">
        <div class="card text-white" style="background-color:#009cea !important; border-color: #009cea !important; ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="kk kk-users2"></i>
            </div>
            <div class="h4 mb-0">Utilisateurs</div>
            <small>Gestion Utilisateurs</small>
          </div>
        </div>
      </div>
      <!--/.end-->


    <!-- Soutenances -->
    <div id="7" class="col-sm-6 col-md-2">
        <div class="card text-white" style="background-color:#27ae60 !important; border-color: #27ae60 !important; ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="kk kk-approval"></i>
            </div>
            <div class="h5 mb-0">Soutenances</div>
            <small>Gestion Des Stages</small>
          </div>
        </div>
      </div>
      <!--/.end-->

<!-- Div -->
<div id="10" class="col-sm-6 col-md-2">
    <div class="card text-white" style="background-color:#1F4788 !important; border-color: #1F4788 !important; ">
      <div class="card-body">
        <div class="h1 text-muted text-right mb-4">
          <i class="kk kk-department"></i>
        </div>
        <div class="h5 mb-0">Stages</div>
        <small>Gestion Des Stages</small>
      </div>
    </div>
  </div>
  <!--/.end-->

    <!-- Soutenances -->
    <div id="5" class="col-sm-6 col-md-2">
        <div class="card text-white" style="background-color:#e67e22 !important; border-color: #e67e22 !important; ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="kk kk-pos"></i>
            </div>
            <div class="h5 mb-0">Sociétés</div>
            <small>Tous les Sociétés</small>
          </div>
        </div>
      </div>
      <!--/.end-->

    <!-- Soutenances -->
    <div id="6" class="col-sm-6 col-md-2">
        <div class="card text-white" style="background-color:#7f8c8d !important; border-color: #7f8c8d !important; ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="kk kk-send3"></i>
            </div>
            <div class="h5 mb-0">Mailer</div>
            <small>Envoyer Emails</small>
          </div>
        </div>
      </div>
      <!--/.end-->





  


    


   

  <!-- Div -->
  <div id="rapports" class="col-sm-6 col-md-2">
      <div class="card text-white" style="background-color:#c0392b !important; border-color: #c0392b !important; ">
        <div class="card-body">
          <div class="h1 text-muted text-right mb-4">
            <i class="kk kk-piechart"></i>
          </div>
          <div class="h5 mb-0">Rapports</div>
          <small>Tous les rapports</small>
        </div>
      </div>
    </div>
    <!--/.end-->
















    
  </div>





<br>


<div class="container-fluid">
<div class="row">
<!--
    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body p-3 clearfix">
          <i class="kk kk-users2 p-3 font-2xl mr-3 float-left"></i>
          <div class="h5 text-primary mb-0 mt-2"> {{App\Http\Controllers\GetStat::getNumberofStudents()}} </div>
          <div class="text-muted text-uppercase font-weight-bold font-xs"><i class="icon-badge"></i> Students</div>
        </div>
        <div class="card-footer px-3 py-2">
          <a class="font-weight-bold font-xs btn-block text-muted" href="{{ route('students') }}">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
        </div>
      </div>
    </div>
  

    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body p-3 clearfix">
          <i class="kk kk-camera-bag p-3 font-2xl mr-3 float-left"></i>
          <div class="h5 text-success mb-0 mt-2">{{App\Http\Controllers\GetStat::getNumberofTeachers()}}</div>
          <div class="text-muted text-uppercase font-weight-bold font-xs"><i class="icon-badge"></i> Teachers</div>
        </div>
        <div class="card-footer px-3 py-2">
          <a class="font-weight-bold font-xs btn-block text-muted" href="{{ route('teachers') }}">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body p-3 clearfix">
          <i class="kk kk-department p-3 font-2xl mr-3 float-left"></i>
          <div class="h5 text-warning mb-0 mt-2">{{App\Http\Controllers\GetStat::getNumberofInternships()}}</div>
          <div class="text-muted text-uppercase font-weight-bold font-xs"><i class="icon-badge"></i> Interships</div>
        </div>
        <div class="card-footer px-3 py-2">
          <a class="font-weight-bold font-xs btn-block text-muted" href="#">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
        </div>
      </div>
    </div>
  

    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body p-3 clearfix">
          <i class="kk kk-presentation-text  p-3 font-2xl mr-3 float-left"></i>
          <div class="h5 text-danger mb-0 mt-2">{{App\Http\Controllers\GetStat::getNumberofDefences()}}</div>
          <div class="text-muted text-uppercase font-weight-bold font-xs"><i class="icon-badge"></i> Defences</div>
        </div>
        <div class="card-footer px-3 py-2">
          <a class="font-weight-bold font-xs btn-block text-muted" href="#">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
        </div>
      </div>
    </div>
 
  </div>

-->

<div class="card-columns cols-2">


                <div class="card">
                    <div class="card-header">
                     <i class="kk kk-users"></i> Students (By Groups)
                    </div>
                    <div class="card-body">
                      <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="canvas-5" style="display: block; width: 483px; height: 241px;" width="483" height="241" class="chartjs-render-monitor"></canvas>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                      <div class="card-header">
                          <i class="kk kk-Activity"></i>  Activites

                      </div>
                      <div class="card-body">
                        <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>

                        <div style="display: block; width: 483px; height: 241px;" width="483" height="241" class="chartjs-render-monitor">
                           <div>
                                <div>
                                  <i class="icon-user-follow bg-warning p-4 font-2xl mr-3 float-left"></i>
                                  <div class="h5 text-warning mb-0 pt-3">{{\App\Http\Controllers\GetStat::getNBwaitingUsers()}}</div>
                                  <div class="text-muted text-uppercase font-weight-bold font-xs">Pending Accounts</div>
                                </div>

                                <br>

                                <div>
                                    <i class="icon-user-following bg-success p-4 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-success mb-0 pt-3">{{\App\Http\Controllers\GetStat::getNBacceptedUsers()}}</div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Accepted Users</div>
                                </div>
                                <br>
                                <div>
                                    <i class="icon-user-unfollow bg-danger p-4 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-danger mb-0 pt-3">{{\App\Http\Controllers\GetStat::getNBrejectedUsers()}}</div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Rejected Users</div>
                                </div>

                              </div>



                        </div>


                      </div>
                      </div>
                    </div>
        </div>



 </div>
</div>





  <br id="mycalender">
 





  <div class="card" >
    <div class="card-body">
      <div class="row">
        <div class="col-sm-5">
          <h4 class="card-title mb-0"><i class="kk kk-calendar-plus"></i> Defences</h4>
          <div class="small text-muted">List of Defences</div>
        </div>
        <!--/.col-->
        <div class="col-sm-7 d-none d-md-block">
          <button type="button" class="btn btn-primary float-right"  onclick="location='../dashboard/pdf/soutenances'"><i class="icon-cloud-download"></i> Download As PDF</button>
          <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
            </div>
          </div>
        </div>
        <!--/.col-->
      </div>
      <!--/.row-->
    
      <div class="chart-wrapper" style="height:auto;margin-top:40px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div >
                <!-- calendar -->
                <div class="row" >
                        <div class="col-12">

                                <script>

                                        $(document).ready(function() {

                                          $('#calendar').fullCalendar({
                                            height: 600,
                                            header: {
                                              left: 'prev,next today',
                                              center: 'title',
                                              right: 'month,basicWeek,basicDay,listMonth'
                                            },
                                            defaultDate: '2018-01-01',
                                            navLinks: true, // can click day/week names to navigate views
                                            editable: false,
                                            eventLimit: true, // allow "more" link when too many events
                                            events: [
                                              {!! \App\Http\Controllers\GetStat::get_calendar_dates()!!}
                                            ],
                                            
                                          });

                                        });

                                      </script>

                                <div id='calendar'></div>
                        </div>




                </div>




        </div>
      </div>












    </div>

  </div>





<script>
    $('#1').css( 'cursor', 'pointer' );
    $('#2').css( 'cursor', 'pointer' );
    $('#3').css( 'cursor', 'pointer' );
    $('#4').css( 'cursor', 'pointer' );
    $('#5').css( 'cursor', 'pointer' );
    $('#6').css( 'cursor', 'pointer' );
    $('#7').css( 'cursor', 'pointer' );
    $('#8').css( 'cursor', 'pointer' );
    $('#9').css( 'cursor', 'pointer' );
    $('#10').css( 'cursor', 'pointer' );
    $('#11').css( 'cursor', 'pointer' );
    $('#12').css( 'cursor', 'pointer' );
    $('#rapports').css( 'cursor', 'pointer' );
    
  
$('#1').click(function() {
  swal({
    title: '<h3>Selectionner :</h3>',
   
    html:
      `<div class="row">
        <div class="col-md-4 col-sm-12" style="cursor:pointer" >


            <div class="card text-white" style="background-color:#009cea !important; border-color: #009cea !important; cursor:pointer"   id="all_users" >
                <div class="card-body">
                  <div class="h1 text-muted text-center mb-4">
                    <i class="kk kk-users2"></i>
                  </div>
                  <div class="h6 mb-0">All Users</div>
                </div>
              </div>


        </div>  
        <div id="user_etudiant" class="col-md-4 col-sm-12"  style="cursor:pointer">
         
            <div class="card text-white" style="background-color:rgb(67, 181, 31) !important; border-color: rgb(67, 181, 31) !important; cursor:pointer">
                <div class="card-body">
                  <div class="h1 text-muted text-center mb-4">
                    <i class="kk kk-users"></i>
                  </div>
                  <div class="h6 mb-0">Étudiants</div>
                 
                </div>
              </div>

        </div>

        <div id="user_enseignants" class="col-md-4 col-sm-12"  style="cursor:pointer">

            <div class="card text-white" style="background-color:#C91F37 !important; border-color: #C91F37 !important; cursor:pointer ">
                <div class="card-body">
                  <div class="h1 text-muted text-center mb-4">
                    <i class="kk kk-camera-bag"></i>
                  </div>
                  <div class="h6 mb-0">Enseignants</div>
                  
                </div>
              </div>
        </div>


        <div id="user_admin"  class="col-md-4 col-sm-12"  style="cursor:pointer">
            <div class="card text-white" style="background-color:#8e44ad !important; border-color: #8e44ad !important; cursor:pointer">
                <div class="card-body">
                  <div class="h1 text-muted text-center mb-4">
                    <i class="kk kk-reading_ebook"></i>
                  </div>
                  <div class="h6 mb-0">Admins</div>
                  
                </div>
              </div>
        </div>

        <div id="user_accept" class="col-md-4 col-sm-12"  style="cursor:pointer">
            <div class="card text-white" style="background-color:#27ae60 !important; border-color: #27ae60 !important; cursor:pointer">
                <div class="card-body">
                  <div class="h1 text-muted text-center mb-4">
                    <i class="kk kk-plus"></i>
                  </div>
                  <div class="h6 mb-0" style="font-size: 12px !important;">Accepter Users</div>
                  
                </div>
              </div>
        </div>
        <div id="user_upgrade" class="col-md-4 col-sm-12"  style="cursor:pointer">
            <div class="card text-white" style="background-color:#2c3e50 !important; border-color: #2c3e50 !important; cursor:pointer">
                <div class="card-body">
                  <div class="h1 text-muted text-center mb-4">
                    <i class="kk kk-Arrow-Up"></i>
                  </div>
                  <div class="h6 mb-0" style="font-size: 12px !important;">Upgrade Users</div>
                  
                </div>
              </div>
        </div>


      </div>`,
      width: "80%",
      showCloseButton: true,
      showConfirmButton: false
    
   
    
  })
  //window.location.href="./dashboard/Users/All"; 
});

$('#rapports').click(function() {
  window.location.href="./dashboard/reports"; 
});


$('#2').click(function() {
  window.location.href="./dashboard/Users/Students"; 
});

$('#3').click(function() {
  window.location.href="./dashboard/Users/Teachers"; 
});

$('#4').click(function() {
  window.location.href="./group"; 
});

$('#5').click(function() {
  window.location.href="./dashboard/Companies"; 
});

$('#6').click(function() {
  window.location.href="./dashboard/Mailer"; 
});

$('#7').click(function() {
  
  swal({
    title: '<h3>Selectionner :</h3>',
   
    html:
      `<div class="row">

          <div id="soutenance_all" class="col-md-3 col-sm-12"  style="cursor:pointer">
              <div class="card text-white" style="background-color:#27ae60 !important; border-color: #27ae60 !important; ">
                  <div class="card-body">
                    <div class="h1 text-muted text-center mb-4">
                      <i class="kk kk-list-view"></i>
                    </div>
                    <div class="h5 mb-0">Soutenances</div>
                    <small>Tous les Soutenances</small>
                  </div>
                </div>
          </div>

          <div id="soutenance_valide" class="col-md-3 col-sm-12"  style="cursor:pointer">
              <div class="card text-white" style="background-color:#27ae60 !important; border-color: #27ae60 !important; ">
                  <div class="card-body">
                    <div class="h1 text-muted text-center mb-4">
                      <i class="kk kk-approval"></i>
                    </div>
                    <div class="h5 mb-0">Soutenances</div>
                    <small>Validées</small>
                  </div>
                </div>
          </div>


         
          <div id="soutenance_waiting" class="col-md-3 col-sm-12"  style="cursor:pointer">
              <div class="card text-white" style="background-color:#27ae60 !important; border-color: #27ae60 !important; ">
                  <div class="card-body">
                    <div class="h1 text-muted text-center mb-4">
                      <i class="kk kk-loader-circles"></i>
                    </div>
                    <div class="h5 mb-0">Soutenances</div>
                    <small>En Attente</small>
                  </div>
                </div>
          </div>



        
          <div id="soutenance_nonvalide" class="col-md-3 col-sm-12"  style="cursor:pointer">
              <div class="card text-white" style="background-color:#27ae60 !important; border-color: #27ae60 !important; ">
                  <div class="card-body">
                    <div class="h1 text-muted text-center mb-4">
                      <i class="kk kk-error"></i>
                    </div>
                    <div class="h5 mb-0">Soutenances</div>
                    <small>Non Validées</small>
                  </div>
                </div>
          </div>



      </div>`,
      width: "80%",
      showCloseButton: true,
      showConfirmButton: false
    
   
    
  })
  
  //window.location.href="#"; 
});

$('#8').click(function() {
  window.location.href="#"; 
});

$('#9').click(function() {
  window.location.href="#"; 
});

$('#10').click(function() {
  swal({
    title: '<h3>Selectionner :</h3>',
   
    html:
      `<div class="row">

          <div id="stage_all" class="col-md-3 col-sm-12"  style="cursor:pointer">
              <div class="card text-white" style="background-color:#1F4788 !important; border-color: #1F4788 !important; ">
                  <div class="card-body">
                    <div class="h1 text-muted text-center mb-4">
                      <i class="kk kk-department"></i>
                    </div>
                    <div class="h5 mb-0">Stages</div>
                    <div class="h6 text-muted text-center" style="font-size: 12px !important;">Tous les stages</div>
                  </div>
                </div>
          </div>

          <div id="stage_init" class="col-md-3 col-sm-12"  style="cursor:pointer">              <div class="card text-white" style="background-color:#1F4788 !important; border-color: #1F4788 !important; ">
                  <div class="card-body">
                    <div class="h1 text-muted text-center mb-4">
                      <i class="kk kk-department"></i>
                    </div>
                    <div class="h5 mb-0">Stages</div>
                    <div class="h6 text-muted text-center" style="font-size: 12px !important;">Initiation</div>
                  </div>
                </div>
          </div>

          <div id="stage_perf" class="col-md-3 col-sm-12"  style="cursor:pointer">
              <div class="card text-white" style="background-color:#1F4788 !important; border-color: #1F4788 !important; ">
                  <div class="card-body">
                    <div class="h1 text-muted text-center mb-4">
                      <i class="kk kk-department"></i>
                    </div>
                    <div class="h5 mb-0">Stages</div>
                    <div class="h6 text-muted text-center" style="font-size: 10px !important;">Perfectionnement</div>
                  </div>
                </div>
          </div>

          <div id="stage_pfe" class="col-md-3 col-sm-12"  style="cursor:pointer">
              <div class="card text-white" style="background-color:#1F4788 !important; border-color: #1F4788 !important; ">
                  <div class="card-body">
                    <div class="h1 text-muted text-center mb-4">
                      <i class="kk kk-graduation_cap"></i>
                    </div>
                    <div class="h5 mb-0">Stages</div>
                    <div class="h6 text-muted text-center" style="font-size: 12px !important;">PFE</div>
                  </div>
                </div>
          </div>


      </div>`,
      width: "80%",
      showCloseButton: true,
      showConfirmButton: false
    
   
    
  })
  //window.location.href="./dashboard/Interships/all"; 
});

$('#11').click(function() {
  window.location.href="./dashboard/Interships/perf"; 
});


$('#12').click(function() {
  window.location.href="./dashboard/Interships/pfe"; 
});

</script>




<!-- Chart Code -->
<script>


    $(function (){
      'use strict';
    
      var pieData = {
        {!!  \App\Http\Controllers\GetStat::javascriptchart() !!}
          backgroundColor: [
            '#FF6384',
            '#36A2EB',
            '#FFCE56',
            '#EE6352',
            '#8ACB88'
          ],
          hoverBackgroundColor: [
            '#FF6384',
            '#36A2EB',
            '#FFCE56',
            '#EE6352',
            '#8ACB88'
          ]
        }]
      };
      var ctx = document.getElementById('canvas-5');
      var chart = new Chart(ctx, {
        type: 'pie',
        data: pieData,
        options: {
          responsive: true
        }
      });
    
    
  
  
  });
</script>





<script>

  /* Change URL (using on Function) */

    $( "body" ).on( "click", "#all_users", function() {
         window.location.href="./dashboard/Users/All"; 
    });

    $( "body" ).on( "click", "#user_etudiant", function() {
      window.location.href="./dashboard/Users/Students"; 
   });

    $( "body" ).on( "click", "#user_enseignants", function() {
      window.location.href="./dashboard/Users/Teachers"; 
    });

    $( "body" ).on( "click", "#user_admin", function() {
      window.location.href="./dashboard/Users/Admins"; 
    });

    $( "body" ).on( "click", "#user_accept", function() {
      window.location.href="./dashboard/Requests"; 
    });

    $( "body" ).on( "click", "#user_upgrade", function() {
      window.location.href="./dashboard/UpgradeUser"; 
    });

    $( "body" ).on( "click", "#soutenance_all", function() {
      window.location.href="./dashboard/defenses/all";
    });

    $( "body" ).on( "click", "#soutenance_valide", function() {
      window.location.href="./dashboard/defenses/accepted";
    });

    $( "body" ).on( "click", "#soutenance_waiting", function() {
      window.location.href="./dashboard/defenses/waiting";
    });

    $( "body" ).on( "click", "#soutenance_nonvalide", function() {
      window.location.href="./dashboard/defenses/rejected"; 
    });

    $( "body" ).on( "click", "#stage_all", function() {
      window.location.href="./dashboard/Interships/all"; 
    });

    $( "body" ).on( "click", "#stage_init", function() {
      window.location.href="./dashboard/Interships/init";
    });

    $( "body" ).on( "click", "#stage_perf", function() {
      window.location.href="./dashboard/Interships/perf";
    });

    $( "body" ).on( "click", "#stage_pfe", function() {
      window.location.href="./dashboard/Interships/pfe";
    });



</script>



















@endsection
