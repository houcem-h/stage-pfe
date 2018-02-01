@extends('dashboards.admin.appdash')


@section('dash_content')
<br>



<div class="card">
        <div class="card-header">
                <i class="icon-people"></i> Download Reports 
              </div>
    <div class="card-body">

        <div class="center-block">
        
         
              
                <h3>Filtre : (Par Note)</h3>
                <div class="row">
                        <div class="col-md-3">
                                <label><strong>Année Universitaire : </strong></label>
                                <select class="form-control" id="f1_1">
                                        <option>--- Selectionner ---</option>
                                        <option value="2016-2017">2016/2017</option>
                                        <option value="2017-2018">2017/2018</option>
                                        <option value="2018-2019">2018/2019</option>
                                        <option value="2019-2020">2019/2020</option>
                                        <option value="2020-2021">2020/2021</option>
                                        <option value="2021-2022">2021/2022</option>
                                        <option value="2022-2023">2022/2023</option>
                                      </select>
                        </div>
                        <div class="col-md-3">
                                        <label><strong>Type : &nbsp;&nbsp;</strong></label>
                                        <input type="radio" type="form-control" name="foo" value="egal" checked> 
                                       
                                        <label>égal à : </label>

                                        <input type="radio" type="form-control" name="foo" value="noteq"> 

                                        <label>Different de : </label>


                                        <select class="form-control" id='f1_2'>
                                                <option>--- Selectionner ---</option>
                                                <option value="all">Toutes les classes</option>
                                                <option value="init">Initation</option>
                                                <option value="perf">Perfectionnement</option>
                                                <option value="pfe">PFE</option>
                                              </select>
                        </div>
                        <div class="col-md-2">
                                <label><strong>Note Suppérieur à :</strong></label>
                                <input class="form-control" type="number" id="f1_3" value="0" min="0" max="20">
                                
                        </div>
                        <div class="col-md-4">
                                        
                                <label><strong>Download </strong></label><br>
                                <button class="btn btn-danger" onclick='redirect_to_pdf1();'>Download PDF</button>
                                        
                                
                        </div>
                </div>
                <hr>

                


















                

                <h3>Filtre : (Par Enseignants)</h3>
                <div class="row">
                        <div class="col-md-2">
                                <label><strong>Année Universitaire : </strong></label>
                                <select class="form-control" id="f2_1">
                                        <option>--- Selectionner ---</option>
                                        <option value="2012-2013">2012/2013</option>
                                        <option value="2013-2014">2013/2014</option>
                                        <option value="2014-2015">2014/2015</option>
                                        <option value="2015-2016">2015/2016</option>
                                        <option value="2016-2017">2016/2017</option>
                                        <option value="2017-2018">2017/2018</option>
                                        <option value="2018-2019">2018/2019</option>
                                        <option value="2019-2020">2019/2020</option>
                                        <option value="2020-2021">2020/2021</option>
                                        <option value="2021-2022">2021/2022</option>
                                        <option value="2022-2023">2022/2023</option>
                                      </select>
                        </div>
                        <div class="col-md-2">
                                        
                                        <label><strong>Niveau :</strong></label>
                                        <select class="form-control" id="f2_2">
                                                <option>--- Selectionner ---</option>
                                                
                                                <option value="init">Initation</option>
                                                <option value="perf">Perfectionnement</option>
                                                <option value="pfe">PFE</option>
                                              </select>
                        </div>
                        <div class="col-md-2">
                                <label><strong>Enseignant :</strong></label>
                               
                                        <select class="form-control" id="f2_3">
                                                <option> -- Selectionner ---</option>
                                                        @foreach($Teachers as $Teacher)
                                                                <option value="{{$Teacher->id}}">{{$Teacher->firstname}} {{$Teacher->lastname}}</option>
                                                        @endforeach
                                        </select>          
                                
                        </div>
                        <div class="col-md-2">
                                        <label>Rapporteur : </label>
                                        <input type="radio" type="form-control" name="foo2" value="reporter" checked> 
                                        <label>Président : </label>
                                        <input type="radio" type="form-control" name="foo2" value="president"> 
                        </div>
                        <div class="col-md-4">
                                       
                                  
                                <label><strong>Download : </strong></label><br>
                                <button onclick="redirect_to_pdf2();" class="btn btn-danger">Download PDF</button>
                                
                        </div>
                </div>

                <hr>

               



                        <br>
                        <div class="row">
                                        <div class="col-md-4 text-right">
                                                <h3>Lettres d'affectations</h3>
                                                
                                        </div>
                                        <div class="col-md-3">
                                                        <input type="text" class="form-control" id="datepicker" placeholder="Date d'impression...">
                                                        
                                        </div>
                                        <div class="col-md-4">
                                                        <button class="btn btn-danger" id="lettre_affect_pdf">Download PDF</button>
                                                        
                                        </div>
                                        <script>
                                                        $("#lettre_affect_pdf").click(function() {
                                                                var mydate =  $("#datepicker").val() ;
                                                                
                                                                if (mydate != "") {
                                                                        swal({
                                                                                title: 'Veuillez Patienter ...',
                                                                                text: 'En Cours de générer PDF',
                                                                                
                                                                                onOpen: () => {
                                                                                        swal.showLoading()
                                                                                      }
                                                                        });
                                                                        window.location = "../dashboard/pdf/affectation/" + mydate ;
                                                                }
                                                       });
                                                 </script>
                        </div>
<br>
                        <div class="row">
                                        <div class="col-md-4 text-right">
                                                <h3>Invitations (Juri PFE)</h3>
                                                
                                        </div>
                                        <div class="col-md-3">
                                                        <input type="text" class="form-control" id="datepicker2" placeholder="Date d'impression...">
                                                        
                                        </div>
                                        <div class="col-md-4">
                                                        <button class="btn btn-danger" id="invit_pdf">Download PDF</button>
                                                        
                                        </div>
                                        <script>
                                                        $("#invit_pdf").click(function() {
                                                                var mydate2 =  $("#datepicker2").val() ;
                                                                
                                                                if (mydate2 != "") {
                                                                        swal({
                                                                                title: 'Veuillez Patienter ...',
                                                                                text: 'En Cours de générer PDF',
                                                                                
                                                                                onOpen: () => {
                                                                                        swal.showLoading()
                                                                                      }
                                                                        });
                                                                        window.location = "../dashboard/pdf/invit/" + mydate2 ;
                                                                }
                                                       });
                                                 </script>
                        </div>

                <hr>

              <!--  <h3>Filtre : (Par Société)</h3>
                <div class="row">
                        <div class="col-md-4">
                                <label><strong>Année Universitaire : </strong></label>
                                <select class="form-control" >
                                        <option>--- Selectionner ---</option>
                                        <option>2017/2018</option>
                                        <option>2018/2019</option>
                                        <option>2019/2020</option>
                                        <option>2020/2021</option>
                                        <option>2021/2022</option>
                                        <option>2022/2023</option>
                                        <option>2023/2024</option>
                                      </select>
                        </div>
                        <div class="col-md-2">
                                        <label><strong>Niveau :</strong></label>
                                        <select class="form-control" >
                                                <option>--- Selectionner ---</option>
                                                <option>Toutes les classes</option>
                                                <option>3eme</option>
                                                <option>2eme</option>
                                                <option>1ere</option>
                                              </select>
                        </div>
                        <div class="col-md-2">
                                        <label><strong>Société :</strong></label>
                                       
                                                <select class="form-control" >
                                                        <option> -- Selectionner ---</option>
                                                        
                                                                <option>XXXXXX</option>
                                                                <option>YYYYYY</option>
                                                                <option>ZZZZZZ</option>
                                                </select>          
                                        
                                </div>
                        <div class="col-md-4">
                                <label><strong>Download : </strong></label><br>
                                <button class="btn btn-danger">Download PDF</button>
                                
                        </div>
                </div>
        -->
   






                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                            <h3>Étudiants</h3><br>
                            <h1><i class="kk kk-file-acrobat"></i></h1>
                            
                            <a class="btn btn-danger" href="{{ route('studentspdf') }}">Liste Des Étudiants (PDF)</a>
                            <br> <br><br>
                            <h1><i class="kk kk-file-excel"></i></h1>
                            <a class="btn btn-success" href="{{ route('studentsxls') }}">Liste Des Étudiants (Excel)</a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                            <h3>Enseignants </h3><br>
                            <h1><i class="kk kk-file-acrobat"></i></h1>
                            
                            <a class="btn btn-danger" href="{{ route('teacherspdf') }}">Liste Des Enseignants (PDF)</a>
                            <br> <br><br>
                            <h1><i class="kk kk-file-excel"></i></h1>
                            <a class="btn btn-success" href="{{ route('teachersxls') }}">Liste Des Enseignants (Excel)</a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                            <h3>Soutenances</h3><br>
                            <h1><i class="kk kk-file-acrobat"></i></h1>
                            
                            <a class="btn btn-danger" href="#">Under Construction</a>
                            <br> <br><br>
                            <h1><i class="kk kk-file-excel"></i></h1>
                            <a class="btn btn-success" href="#">Under Construction</a>
                    </div>







                </div>



          
    
    
    
    
        
        </div>


    </div>
</div>

<script>

                
        
                                $( function() {
                                  $( "#datepicker" ).datepicker({
                                          dateFormat: "dd-mm-yy"
                                  });
                                  $( "#datepicker2" ).datepicker({
                                        dateFormat: "dd-mm-yy"
                                });
                                } );
                        


        function  redirect_to_pdf1() {

                var x1 = $("#f1_1").val(); //Année universitaire
                var x2 = $("#f1_2").val(); //type : all - init - perf - pfe
                var x3 = $("#f1_3").val(); // minimun value
                var x4 = $("input[name=foo]:checked").val(); //equal or noteq

                if(x2 == "all") {
                        window.location = "../pdf/reports_1/" + x1 + "/noteq/X/" + x3;
                }
                else {
                        window.location = "../pdf/reports_1/" + x1 + "/" + x4 + "/" + x2 + "/" + x3;
                }
               
             }
       
             function  redirect_to_pdf2() {

                var x1 = $("#f2_1").val(); //Année universitaire
                var x2 = $("#f2_2").val(); //type : all - init - perf - pfe
                var x3 = $("#f2_3").val(); // minimun value
                var x4 = $("input[name=foo2]:checked").val(); //equal or noteq

                if(x4 == "reporter") {
                        window.location = "../pdf/reporter/" + x1 + "/" + x2 + "/" + x3;
                }
                else {
                        window.location = "../pdf/reports_1/" + x1 + "/" + x4 + "/" + x2 + "/" + x3;
                }
               
             }

             

</script>

@endsection