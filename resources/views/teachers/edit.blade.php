@extends('layouts.app')

@section('content')

<style media="screen">
input[type=submit] {
  background: #fff0;;
    border: 0;

}

</style>

<div class="col-lg-8 col-md-8 col-lg-offset-2">
    <div class="card">
        <div class="card-header" data-background-color="bleu">
            <h4 class="title">Editer l'enseignant <strong>{{$teacher->firstname}} {{$teacher->lastname}}</h4>
            <p class="category"></p>
        </div>
        <div class="card-content table-responsive">
          {!! Form::open(['action' => ['TeachersController@update',$teacher->id]]) !!}
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
                      {!! Form::label('phone', 'Téléphone'); !!}
                      {!! Form::text('phone',$teacher->phone,['class'=>'form-control', 'placeholder'=>'Téléphone']); !!}
              </div>
              <div class="form-group">
                      {!! Form::label('role', 'Role'); !!}
                      <select class='form-control' name='role'>
                          <option value='1' @if($teacher->role === 1) selected @endif>Enseignant</option>
                          <option value='2' @if($teacher->role === 2) selected @endif>Administrateur</option>
                      </select>
              </div>

            </div>

        <div class="card-footer  pull-right btn sendbtn" >
          {{Form::hidden('_method','PUT')}}
          {!! Form::submit('Mettre à jour') !!}
      {!! Form::close() !!}
        </div>
        <div class="card-footer btn deletebtn  pull-left"  style="background-color:#f26058">
          <a style="color:snow"href="{{ URL::previous() }}">Retour</a>
        </div>
  </div>
  </div>
@endsection
