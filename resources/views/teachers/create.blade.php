@extends('layouts.app')

@section('content')
  <style media="screen">
  input[type="submit"]{
    background-color:  rgba(0, 0, 0, 0);
    border-color: rgba(0, 0, 0, 0);
  }

  </style>
  <div class="col-lg-8 col-md-8 col-lg-offset-2">
      <div class="card">
          <div class="card-header" data-background-color="bleu">
              <h4 class="title">Ajouter un enseignant  </h4>
              <p class="category"></p>
          </div>
          <div class="card-content ">
            {!! Form::open(['action' => 'TeachersController@store', 'method' => 'POST' ]) !!}
            <div class="form-group">
              {!! Form::label('firstname', 'Prénom'); !!}
              {!! Form::text('firstname','',['class'=>'form-control', 'placeholder'=>'Prénom']); !!}
            </div>
            <div class="form-group">
              {!! Form::label('lastname', 'Nom'); !!}
              {!! Form::text('lastname','',['class'=>'form-control', 'placeholder'=>'Nom']); !!}
            </div>
            <div class="form-group">
              {!! Form::label('birthdate', 'date de naissance'); !!}
              {!! Form::date('birthdate','',['class'=>'form-control', 'placeholder'=>'date ']); !!}
            </div>
            <div class="form-group">
              {!! Form::label('cin', 'N° CIN'); !!}
              {!! Form::text('cin','',['class'=>'form-control', 'placeholder'=>'N° CIN']); !!}
            </div>
            <div class="form-group">
              {!! Form::label('email', 'Adresse E-Mail'); !!}
              {!! Form::text('email','',['class'=>'form-control', 'placeholder'=>'Adresse E-Mail']); !!}
            </div>
            <div class="form-group">
              {!! Form::label('phone', 'Téléphone'); !!}
              {!! Form::text('phone','',['class'=>'form-control', 'placeholder'=>'Téléphone']); !!}
            </div>
            <div class="form-group">
              {!! Form::label('role', 'Role'); !!}
              <select class='form-control' name='role'>
                <option value='1' >Enseignant</option>
                <option value='2'>Administrateur</option>
              </select>
            </div>
          </div>

            {!! Form::submit('Crée',['class'=>'btn sendbtn pull-right','data-background-color'=>'bleu']) !!}
        {!! Form::close() !!}

          <a href= "{{ URL::previous() }}">
              <button class="btn deletebtn" style="width:100px;color:snow;background-color:#f26058">Retour</button>
          </a>

        </div>
          </div>




        @endsection
