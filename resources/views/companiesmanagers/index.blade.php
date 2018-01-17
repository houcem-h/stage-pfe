@extends('layouts.app')
@section('content')
  <div class="container">
     <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a class="btn btn-default" href="{{URL::previous()}}" style="margin-bottom:50px;">Go Back</a>
             @forelse($companiesmanagers as $manager)
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <h5 class="text-center">{{$manager->name}}</h5>
                    </div>
                    <div class="panel-body">
                       <table class="table" style="border:none;">

                           <tr>
                               <td><strong>Email : </strong></td>
                               <td><span class="tdvalue">{{$manager->email}}</td>
                           </tr>  

                           <tr>
                               <td><strong>Phone : </strong></td>
                               <td><span class="tdvalue">{{$manager->phone}}</td>
                           </tr>                                                    
                       </table>
                    </div>
                    <div class="panel-footer">
                       <a href="/companiesmanagers/{{$manager->id}}">More Details</a>
                    </div>
                    
                </div>
             @empty
               <h3 class="text-center" style="color:black;">No Companies Managers Available</h3>
             @endforelse
             <div class="col-md-4 col-md-offset-4">
                {{$companiesmanagers->links()}}
             </div>
        </div>
     </div>
  </div>
@endsection