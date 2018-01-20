@extends('dashboards.admin.appdash')


@section('dash_content')
<br>
<div class="row">





<!-- START Students / Teacher / Companies / Defences -->

    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body p-3 clearfix">
          <i class="kk kk-users2 p-3 font-2xl mr-3 float-left"></i>
          <div class="h5 text-primary mb-0 mt-2">253</div>
          <div class="text-muted text-uppercase font-weight-bold font-xs"><i class="icon-badge"></i> Students</div>
        </div>
        <div class="card-footer px-3 py-2">
          <a class="font-weight-bold font-xs btn-block text-muted" href="{{ route('students') }}">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
        </div>
      </div>
    </div>
    <!--/.col-->

    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body p-3 clearfix">
          <i class="kk kk-camera-bag p-3 font-2xl mr-3 float-left"></i>
          <div class="h5 text-success mb-0 mt-2">40</div>
          <div class="text-muted text-uppercase font-weight-bold font-xs"><i class="icon-badge"></i> Teachers</div>
        </div>
        <div class="card-footer px-3 py-2">
          <a class="font-weight-bold font-xs btn-block text-muted" href="{{ route('teachers') }}">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
        </div>
      </div>
    </div>
    <!--/.col-->

    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body p-3 clearfix">
          <i class="kk kk-department p-3 font-2xl mr-3 float-left"></i>
          <div class="h5 text-warning mb-0 mt-2">120</div>
          <div class="text-muted text-uppercase font-weight-bold font-xs"><i class="icon-badge"></i> Interships</div>
        </div>
        <div class="card-footer px-3 py-2">
          <a class="font-weight-bold font-xs btn-block text-muted" href="#">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
        </div>
      </div>
    </div>
    <!--/.col-->

    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body p-3 clearfix">
          <i class="kk kk-presentation-text  p-3 font-2xl mr-3 float-left"></i>
          <div class="h5 text-danger mb-0 mt-2">200</div>
          <div class="text-muted text-uppercase font-weight-bold font-xs"><i class="icon-badge"></i> Defences</div>
        </div>
        <div class="card-footer px-3 py-2">
          <a class="font-weight-bold font-xs btn-block text-muted" href="#">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
        </div>
      </div>
    </div>
    <!--/.col-->
  </div>


<!-- END Students / Teacher / Companies / Defences -->

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
                                  <i class="icon-drawer bg-danger p-4 font-2xl mr-3 float-left"></i>
                                  <div class="h5 text-danger mb-0 pt-3">25</div>
                                  <div class="text-muted text-uppercase font-weight-bold font-xs">Pending Accounts</div>
                                </div>

                                <br>

                                <div>
                                    <i class="icon-user-follow bg-warning p-4 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-warning mb-0 pt-3">50</div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Pending Interships</div>
                                </div>
                                <br>
                                <div>
                                    <i class="icon-book-open bg-success p-4 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-success mb-0 pt-3">70</div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Pending Defences</div>
                                </div>

                              </div>



                        </div>


                      </div>
                      </div>
                    </div>
        </div>



 </div>






  <br>






  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-sm-5">
          <h4 class="card-title mb-0"><i class="kk kk-calendar-plus"></i> Defences</h4>
          <div class="small text-muted">List of Defences</div>
        </div>
        <!--/.col-->
        <div class="col-sm-7 d-none d-md-block">
          <button type="button" class="btn btn-primary float-right"><i class="icon-cloud-download"></i> Download As PDF</button>
          <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
            </div>
          </div>
        </div>
        <!--/.col-->
      </div>
      <!--/.row-->

      <div class="chart-wrapper" style="height:auto;margin-top:40px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div>
                <!-- calendar -->
                <div class="row">
                        <div class="col-12">

                                <script>

                                        $(document).ready(function() {

                                          $('#calendar').fullCalendar({
                                            height: 600,
                                            header: {
                                              left: 'prev,next today',
                                              center: 'title',
                                              right: 'month,basicWeek,basicDay'
                                            },
                                            defaultDate: '2018-01-01',
                                            navLinks: true, // can click day/week names to navigate views
                                            editable: false,
                                            eventLimit: true, // allow "more" link when too many events
                                            events: [
                                              {
                                                title: 'Salah Karim',
                                                start: '2018-01-02',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Ahmed Ben Salem',
                                                start: '2018-01-03',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Amira Ben Amir',
                                                start: '2018-01-09',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Mourad Ben Fraj',
                                                start: '2018-01-11',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Motaz ben yassin',
                                                start: '2018-01-13',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Ala Farouk',
                                                start: '2018-01-15',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Salem Ben Abdallah',
                                                start: '2018-01-16',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Amir ben Ayoub',
                                                start: '2018-01-21',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Amin Ben Malek',
                                                start: '2018-01-18',
                                                url: 'https://google.com'
                                              },
                                              {
                                                title: 'Kamel Maghraoui',
                                                start: '2018-01-18',
                                                url: 'https://google.com'
                                              }
                                            ]
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







@endsection
