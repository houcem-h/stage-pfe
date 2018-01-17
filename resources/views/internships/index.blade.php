@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <a class="btn btn-default" style="margin-bottom:50px;" href="{{URL::previous()}}}">Go Back</a>
        @forelse($internships as $internship)
            <div class="panel panel-default">
                <div class="panel-heading">
                     <strong>Stagaire</strong> <a href="{{URL('/internships/'.$internship->id)}}"> {{$internship->registration->studentRecord->firstname}}</a>
                </div>
                <div class="panel-body">
                  <table class="table table-bordred">
                      <tr>
                          <td><strong>start_date</strong></td>
                          <td>{{$internship->start_date}}</td>
                      </tr>
                      <tr>
                          <td><strong>end_date</strong></td>
                          <td>{{$internship->end_date}}</td>
                      </tr>
                      <tr>
                           <td><strong>internship type</strong></td>
                           <td>{{$internship->type}}</td>
                      </tr>
                       <tr>
                           <td><strong>Framer</strong></td>
                           <td>
                            {!!($internship->framerRecord)!=null ? $internship->framerRecord->firstname: '<u>Undifined Until Now</u>'!!}
                           </td>
                       </tr>
                       <tr>
                           <td><strong>Company Framer</strong></td>
                           <td>{{$internship->companyFramer->name}}</td>
                       </tr>
                  </table>
                </div>

            </div>
            @empty
            <h3 class="text-center">No Interships Available</h3>
        @endforelse
        <div class="col-md-6 col-md-offset-3">
            <p class="text-center">{{$internships->links()}}</p>
        </div>
    </div>
</div>
@endsection