@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
      <a style="margin-bottom:50px;" class="btn btn-default" href="{{auth()->user()->Dashboard}}">Go Back</a>
    @forelse($companies as $company)
         <div class="panel panel-default">
            <div class="panel-heading">
              <strong> </strong><h5 class="text-center"> <a href="/company/{{$company->id}}">{{$company->name}}</a></h5>
              </div>
              <div class="panel-body">
                <p>
                  <strong><u>Name : </u></strong>{{$company->name}}<br>
                </p>
                <p>
                  <strong><u>Activity : </u></strong>  {{$company->activity}}<br>
                </p>
                <p>
                  <strong><u>Address : </u> {{$company->address}}</strong>
                </p>
              </div>
              <div class="panel-footer">
                <p><small><strong>Tel : </strong>{{$company->phone}}</small></p>
                @if(isset($company->fax))
                  <p><small><strong>Fax : </strong>{{$company->fax}}</small></p>
                @endif
              </div>
         </div>
    @empty
    <div class="alert alert-warning col-md-6 col-md-offset-3">
        <p><strong>The is No Companies Until Now</strong></p>  
    </div>
    @endforelse
    <div class="col-md-6 col-md-offset-3">
        <p class="text-center">{{$companies->links()}}</p>
    </div>
  </div>
</div>
@endsection