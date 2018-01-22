@extends('layouts.app')
<!-- jQuery -->

<!-- Delay table load until everything else is loaded -->
@section('content')
<style media="screen">
input[type="submit"]{
  background-color:  rgba(0, 0, 0, 0);
  border-color: rgba(0, 0, 0, 0);
}

</style>

<div class="col-md-10 col-md-offset-1">

    @foreach($teachers as $teacher)

      <div class="col-lg-4 col-md-4">

          <div class="card">
              <div class="card-header" data-background-color="bleu">
                  <h4 class="title">{{$teacher->firstname}} {{$teacher->lastname}}</h4>
                  <p class="category">last time changed</p>
              </div>
                <div class="card-content table-responsive">
                  <centre>
                  <p>Email : {{$teacher->email}}</p>
                  <p>Brirth date : {{$teacher->birthdate}}</p>
                  <p>Cin : {{$teacher->cin}}</p>
                  <p>Phone : {{$teacher->phone}}</p>
                  <p>Role : @if ($teacher->role == 2) Administrateur @else Enseignant @endif</p>
                    <hr class="divi">
                </centre>
                </div>

                <div class="card-footer">
                  <a href="teachers/{{$teacher->id}}/edit">
                        <button class="btn btn-primary " style="background: linear-gradient(60deg, #0444ae, #0444ae);">Edit</button>
                 </a>
                  {!!Form::open(['action' => ['TeachersController@destroy', $teacher->id],'method' => 'POST','class'=>'btn btn-danger','style'=>'background: linear-gradient(60deg, #f26058, #f26058); height:36px;'])!!}
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
