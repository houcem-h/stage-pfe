@extends('layouts.app')

@section('content')



<div class="col-lg-8 col-md-8 col-lg-offset-2">
    <div class="card">
        <div class="card-header" data-background-color="bleu">
            <h4 class="title"><strong>Editer Mes information </h4>
            <p class="category">Last time ...</p>
        </div>
        <div class="card-content table-responsive">
          {!! Form::open(['action' => ['DashboardsController@updatepass',$teacher->id]]) !!}
              <div class="form-group">
                      {!! Form::label('firstname', 'Prénom'); !!}
                      {!! Form::text('firstname',$teacher->firstname,['class'=>'form-control', 'placeholder'=>'Prénom']); !!}
              </div>
              <div class="form-group">
                      {!! Form::label('lastname', 'Nom'); !!}
                      {!! Form::text('lastname',$teacher->lastname,['class'=>'form-control', 'placeholder'=>'Nom']); !!}
              </div>
              <div class="form-group">
                      {!! Form::label('birthdate', 'date de naissance'); !!}
                      {!! Form::date('birthdate',$teacher->birthdate,['class'=>'form-control', 'placeholder'=>'Nom']); !!}
              </div>
              <div class="form-group">
                      {!! Form::label('cin', 'N° CIN'); !!}
                      {!! Form::text('cin',$teacher->cin,['class'=>'form-control', 'placeholder'=>'N° CIN']); !!}
              </div>
              <div class="form-group">
                      {!! Form::label('email', 'Adresse E-Mail'); !!}
                      {!! Form::text('email',$teacher->email,['class'=>'form-control', 'placeholder'=>'Adresse E-Mail']); !!}
              </div>
              <div class="form-group">
                      {!! Form::label('password', 'Old Password'); !!}
                      {!! Form::password('password',['class'=>'form-control', 'placeholder'=>'old password']); !!}
              </div>
              <div class="form-group">
                      {!! Form::label('passwordnew', 'New password'); !!}
                      {!! Form::password('passwordnew',['class'=>'form-control', 'placeholder'=>'New password']); !!}
              </div>
              <div class="form-group">
                      {!! Form::label('phone', 'Téléphone'); !!}
                      {!! Form::text('phone',$teacher->phone,['class'=>'form-control', 'placeholder'=>'Téléphone']); !!}
              </div>


            </div>

        <div class="card-footer  pull-right" data-background-color="bleu">
          {{Form::hidden('_method','PUT')}}
          {!! Form::submit('Mettre à jour') !!}
      {!! Form::close() !!}
        </div>
        <div class="card-footer  pull-left"  style="background-color:#f26058">
          <a style="color:snow"href="/">Retour</a>
        </div>
  </div>
  </div>
@endsection
