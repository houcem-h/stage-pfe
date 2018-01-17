@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <a href="/company" style="margin-bottom:50px;" class="btn btn-default">Go Back</a>
            @if(isset($company))
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h6><i class="fa fa-building-o fa-lg" aria-hidden="true"></i> {{ $company->name}} <small class="pull-right">{{$company->address}}</small></h6>
                    </div>
                    <div class="panel-body">
                     <table class="table table-bordred table-stripped table-condensed">
                          <tr>
                              <td><strong>Name <i class="fa fa-building" aria-hidden="true"></i></strong></td>
                              <td><p>{{$company->name}}</p></td>
                          </tr>

                          <tr>
                              <td><strong>Activity <i class="fa fa-users" aria-hidden="true"></i></strong></td>
                              <td><p>{{$company->activity}}</p></td>
                          </tr>

                           <tr>
                              <td><strong>Phone <i class="fa fa-mobile fa-lg" aria-hidden="true"></i></strong></td>
                              <td><p>{{$company->phone}}</p></td>
                          </tr>
                         @if(isset($company->fax))
                          <tr>
                              <td><strong>Fax <i class="fa fa-fax" aria-hidden="true"></i></strong></td>
                              <td>{{$company->fax}}</td>
                          </tr>  
                          @endif  
                          <tr>
                               <td><strong>Adress <i class="fa fa-map-marker" aria-hidden="true"></i></strong></td>
                               <td>{{$company->address}}</td>
                         </tr>
                        </table>
                    </div>
                    
                    <div class="panel-footer">
                      <div class="row">
                          <div class="col-md-5">
                                    @if(isset($company->created_by))
                                    <p><strong>Record Saved By : </strong>{{$company->adminCreator->firstname}} {{$company->adminCreator->lastname}}</p>
                                    @endif
                                    @if(isset($company->updated_by))
                                    <p><strong>Record Updated By : </strong>{{$company->adminUpdator->firstname}} {{$company->adminUpdator->lastname}}</p>
                                    @endif
                          </div>
                          
                          @if(Auth::user()->role==2)
                          <div class="col-md-7">
                              <div class="row">
                                <div class="col-md-6">
                                  <a href="/company/{{$company->id}}/edit" class="btn btn-primary pull-right">Update</a>
                                </div>

                               <div class="col-md-6">
                                {!!Form::open(['method'=>"POST","class"=>"","action"=>["CompaniesController@destroy",$company->id]])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class'=>"btn btn-danger"])}}
                                {!!Form::close()!!}
                               </div>
                            </div>
                        </div>
                        @endif
                     </div>
                    </div>
                </div>
            @endif
    </div>
</div>
@endsection

