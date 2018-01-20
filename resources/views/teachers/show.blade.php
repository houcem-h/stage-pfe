@extends('layouts.app')

@section('content')
    <div class="container">
      <a href="/teachers">
          <button type="button" class="btn btn-default" aria-label="Back">Retour</button>
      </a>
      <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{$teacher->firstname}} {{$teacher->lastname}}</h3>
            </div>
            <div class="panel-body">
                <ul>
                    <li>E-mail : {{$teacher->email}}</li>
                    <li>Téléphone : {{$teacher->phone}}</li>
                    <li>Role : @if ($teacher->role == 2) Administrateur @else Enseignant @endif</li>
                <ul>
            </div>
            <div class="panel-footer">
              <a href="/teachers/{{$teacher->id}}/edit">
                  <button type="button" name="editer" class="btn btn-info">Editer</button>
              </a>
                @if($teacher->userPrivilege < 2)
                {!! Form::open(['action' => ['TeachersController@destroy',$teacher->id],'method'=>'POST', 'class'=>'pull-right']) !!}
                    {{Form::hidden('_method','DELETE')}}
                    {!! Form::submit('Supprimer', ['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
                @endif
            </div>
      </div>
    </div>
