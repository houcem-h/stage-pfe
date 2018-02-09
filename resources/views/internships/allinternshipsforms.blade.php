@extends('layouts.dashboard')
@section('content')
<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        
        <div id="animationloadingbarcontainer">
            <div  id="bar"></div>
        </div>

        {!!Form::open(['method'=>"POST","action"=>"CompaniesController@store",'id'=>"formcreatecompany"])!!}
                <h3 class="text-center" style="color:black;"><b>Informations Societe</b></h3><br><hr><br>
                <div class="form-group">
                    {{Form::label('companyname','Nom')}}
                    {{Form::text('companyname','',['class'=>"form-control","id"=>"companyname"])}}
                </div>

                <div class="form-group">
                    {{Form::label('companyactivity','Activite')}}
                    {{Form::text('companyactivity','',['id'=>"companyactivity",'class'=>"form-control"])}}
                </div>

                <div class="form-group">
                    {{Form::label('companyphone','Telephone')}}
                    {{Form::number('companyphone','',['class'=>"form-control",'id'=>"companyphone"])}}
                </div>

                <div class="form-group">
                    {{Form::label('companyfax','Fax')}}
                    {{Form::number('companyfax','',['id'=>'companyfax','class'=>"form-control"])}}
                </div>

                <div class="form-group">
                    {{Form::label('companyaddress','Adresse')}}
                    {{Form::text('companyaddress','',['id'=>"companyaddress","class"=>"form-control"])}}
                </div>

                <div class="form-group">
                    {{Form::submit('Suivant',['class'=>"btn btn-default"])}}
                </div>

        {!!Form::close()!!}



        {!!Form::open(['method'=>"POST","action"=>"CompaniesManagersController@store",'id'=>"formcreatecompanymanager","style"=>"display:none;"])!!}
                <h3 class="text-center" style="color:black;"><b>Informations Encadreur Societe</b></h3><br><hr><br>
                <div class="form-group">
                    {{Form::label('managername','Nom')}}
                    {{Form::text('managername','',['class'=>"form-control","id"=>"managername"])}}
                </div>

                <div class="form-group">
                    {{Form::label('managerphone','Telephone')}}
                    {{Form::number('managerphone','',['class'=>"form-control",'id'=>"managerphone"])}}
                </div>
                
                <div class="form-group">
                    {{Form::label('manageremail','Email')}}
                    {{Form::email('manageremail','',['id'=>"manageremail",'class'=>"form-control"])}}
                </div>
                <div class="form-group">
                    {{Form::label('managerposition','Position')}}
                    {{Form::text('managerposition','',['id'=>'managerposition','class'=>"form-control"])}}
                </div>

                <div class="form-group">
                    {{Form::submit('Suivant',['class'=>"btn btn-default"])}}
                </div>
        {!!Form::close()!!}

   

        {!!Form::open(["method"=>"POST","url"=>"/internships/store","class"=>"formcreateinternship",'id'=>"formcreateinternship","style"=>"display:none;"])!!}
                <h3 class="text-center" style="color:black;"><b>Informations du Stage</b></h3><br><hr><br>
                <div class="form-group">
                {{Form::label('start_date',"Date Début")}}
                {{Form::date('start_date','',['id'=>"start_date","class"=>"form-control"])}}
                </div>
                <div class="form-group">
                    {{Form::label('end_date','Date Fin')}}
                    {{Form::date('end_date','',['id'=>'end_date','class'=>"form-control"])}}
                </div>
                <div class="form-group">
                    {{Form::label('type','Type')}}
                    {{Form::select('type',(array)auth()->user()->LegalIntershipsTypes,null,['id'=>"type",'class'=>'form-control','placeholder'=>'type de stage'])}}
                </div>
            @if(in_array('pfe',auth()->user()->LegalIntershipsTypes) && Session::has('teachers'))
                <div class="form-group" id="divforframerone" style='display:none;'>
                     {{Form::label('framer','Demande Encadreur')}}
                     {{Form::select('framer',(array)Session::get('teachers'),null,['id'=>'framer','class'=>'form-control','placeholder' => 'selectionner'])}}
                </div>
                <div class="form-group" id="divforbuddy" style="display:none;">
                    {{Form::label('buddy','Binôme')}}
                    {{Form::select('buddy',(array)auth()->user()->Buddy,null,['id'=>'buddy','class'=>'form-control','placeholder' => 'selectionner'])}}
                </div>
                {{Session::forget('teachers')}}              
            @else
                <div class="form-group" style="display:none;">
                     {{Form::label('framer','Encadreur Etablissement')}}
                     {{Form::select('framer',(array)Session::get('teachers'),null,['id'=>'framer','class'=>'form-control','placeholder' => 'selectionner'])}}
                     {{Session::forget('teachers')}}
                </div>            
            @endif
                {{Form::submit('Confirmer',['class'=>'btn btn-default'])}}
        {!!Form::close()!!}
    
      @if(in_array('pfe',auth()->user()->LegalIntershipsTypes))
        {!!Form::open(["method"=>"POST",'action'=>"SpecificationsController@store",'id'=>"formcreatespecification","style"=>"display:none;"])!!}
           <h3 class="text-center" style="color:black;"><b>Cahier De Charge</b></h3><br><hr><br>       
               <div class="form-group">
                   {{Form::label('spectitle','Titre projet')}}
                   {{Form::textarea('spectitle','',['class'=>"form-control",'id'=>'spectitle'])}}
               </div>
               <div class="form-group">
                   {{Form::label('projecttype','Type Du Projet')}}
                   {{Form::textarea('projecttype','',['class'=>"form-control",'id'=>'projecttype'])}}
                </div>      
                <div class="form-group">
                   {{Form::label('existingdesc','Description de l existant')}}
                   {{Form::textarea('existingdesc','Rien n’est développé',['class'=>"form-control",'id'=>'existingdesc'])}}
                </div>  
                <div class="form-group">
                   {{Form::label('requirementspec','Spécification des besions')}}
                   {{Form::textarea('requirementspec','',['class'=>"form-control",'id'=>'requirementspec'])}}
                </div>
                <div class="form-group">
                   {{Form::label('hardwareenv','Environnement matériel')}}
                   {{Form::textarea('hardwareenv','',['class'=>"form-control",'id'=>'hardwareenv'])}}
                </div>  
                <div class="form-group">
                   {{Form::label('softwareenv','Environnement logiciel')}}
                   {{Form::textarea('softwareenv','',['class'=>"form-control",'id'=>'softwareenv'])}}
                </div>                
                <div class="form-group">
                   {{Form::label('provisionalplanning','Planning prévisionnel')}}
                   {{Form::textarea('provisionalplanning','',['class'=>"form-control",'id'=>'provisionalplanning'])}}
                </div>
                {{Form::submit('Confirmer',['class'=>'btn btn-default'])}}                                                
        {!!Form::close()!!}
       @endif
            <div style="display:none;" id="errorsajax" class="col-md-6 col-md-offset-3">
            </div>

            <div style="display:none;" id="successajax" class="col-md-6 col-md-offset-3">
            </div>
   </div>
  </div>
</div>
 <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/ajaxobject.js')}}"></script>
 
 <script type="text/javascript" src="{{ asset('js/ajaxstuffinternshipdemand.js') }}"></script>
@endsection