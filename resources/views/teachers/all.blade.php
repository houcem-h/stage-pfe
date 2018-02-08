@extends('layouts.app')
<!-- jQuery -->

<!-- Delay table load until everything else is loaded -->
@section('content')

<div class="col-md-10 col-md-offset-1">

    @foreach($teachers as $teacher)

      <div class="col-lg-4 col-md-4">

          <div class="card">
              <div class="card-header" data-background-color="bleu">
                  <h4 class="title">{{$teacher->firstname}} {{$teacher->lastname}}</h4>
                  <p class="category"></p>
              </div>
                <div class="card-content table-responsive">
                  <centre>
                  <p>Email : {{$teacher->email}}</p>
                  <p>Date de naissance: {{$teacher->birthdate}}</p>
                  <p>Cin : {{$teacher->cin}}</p>
                  <p>Téléphone : {{$teacher->phone}}</p>
                  <p>Role : @if ($teacher->role == 2) Administrateur @else Enseignant @endif</p>
                    <hr class="divi">
                </centre>
                </div>

                <div class="card-footer">
                  <a href="teachers/{{$teacher->id}}/edit">
                        <button class="btn sendbtn " >modifier</button>
                 </a>
                  <a onclick="event.preventDefault();
                          document.getElementById('delete-form-{{$teacher->id}}').submit();">
                        <button class="btn deletebtn" >Effacer</button>
                 </a>



                  {!!Form::open(['action' => ['TeachersController@destroy', $teacher->id],'id'=>'delete-form-'.$teacher->id.'','method' => 'POST','class'=>'btn btn-danger','style'=>'display:none;'])!!}
                  {{Form::hidden('_method','DELETE')}}
                  {{-- <div class="card-footer pull-left "  style="background-color:#f26058"> --}}
                  {{Form::submit('delete')}}
                  {{-- </div> --}}
                  {!!Form::close()!!}
                </div>



          </div>
          </div>

      @endforeach

@endsection
</div>
