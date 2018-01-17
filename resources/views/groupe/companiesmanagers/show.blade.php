@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="row">
            <a class="btn btn-default" style="margin-bottom:50px;" href="/companiesmanagers">Go Back</a>
              <div class="panel panel-default">
                  <div class="panel-body">
                    <table class="table borderlesstable">
                         <tr>
                             <td><strong>Name : </strong></td>
                             <td><span class="tdvalue">{{$companyManager->name}}</span></td>
                         </tr>
                         <tr>
                             <td><strong>Email : </strong></td>
                             <td><span class="tdvalue">{{$companyManager->email}}</span></td>
                         </tr> 
                         <tr>
                             <td><strong>Phone : </strong></td>
                             <td><span class="tdvalue">{{$companyManager->phone}}</span></td>
                         </tr>           
                         <tr>
                            <td><strong>Company : </strong></td>
                            <td><span class="tdvalue">{{$companyManager->managerCompany->name}}</span></td>
                        </tr>  
                         <tr>
                            <td><strong>Position : </strong></td>
                            <td><span class="tdvalue">{{$companyManager->position}}</span></td>
                        </tr>  
                        <tr><td></td><td></td></tr>                                                                                        
                    </table>
                  </div>
                  <div class="panel-footer">
                        @if(isset($companyManager->created_by))
                          <p><strong>Record Saved By : </strong>{{$companyManager->adminCreator->firstname}} {{$companyManager->adminCreator->lastname}}</p>
                         @endif
                        @if(isset($companyManager->updated_by))
                          <p><strong>Record Updated By : </strong>{{$companyManager->adminUpdator->firstname}} {{$companyManager->adminUpdator->lastname}}</p>
                        @endif
                  </div>
              </div>
        </div>
    </div>
  </div>
@endsection