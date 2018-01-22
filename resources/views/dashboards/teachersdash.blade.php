<style media="screen">

</style>                                                                                       
@extends('layouts.app')
@section('content')
  <div class="container">
  <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="bleu">
                        <h4 class="title">Mes stage PFE</h4>
                        <p class="category">last stage added : last date </p>
                    </div>
                    <div class="card-content table-responsive">
                        {{-- les etudient valide  --}}
                        @if (count($stagers)==0)
                          <h4> You Dont Have </h4>
                        @else
                          <table class="table table-hover">
                            <thead class="text-warning">
                              <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Company</th>
                                <th>Company framer</th>
                                <th>Start date</th>
                                <th>End date</th>
                                {{-- <th>Date</th> --}}
                                <th>information</th>
                                <th>Delete </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($stagers as $stager)
                                <tr>
                                  <td>{{$stager->id}}</td>
                                  <td>{{$stager->nom}}{{$stager->pre}}</td>
                                  <td>{{$company->find($stager->com)->name}}</td>
                                  <td>{{$stager->en}}</td>
                                  <td>{{$stager->start_date}}</td>
                                  <td>{{$stager->end_date}}</td>
                                  {{-- <td> Defense day</td> --}}
                                  <td  style="text-align:center" id="{{ $stager->id }}"><a   data-toggle="modal" data-target="#info" class="toggle-modal-show"><i class="fa fa-search-plus" aria-hidden="true"></i></a></td>
                                  <td style="text-align:center"><a style="color:#f26058" href="dashboard/{{$stager->id}}/ref"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        @endif

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-12">
            <div class="card">
              <div class="card-header" data-background-color="bleu">
                <h4 class="title">Demmande d'encadremeent</h4>
                <p class="category">New employees on 15th September, 2016</p>
              </div>
              <div class="card-content table-responsive">
                    @if (count($waitting)>0)
                      <table class="table table-hover">
                        <thead class="text-warning">
                          <tr>
                            <th>Student Name</th>
                            <th>Company</th>
                            <th>Company framer</th>
                            <th>Accept</th>
                            <th>Refuse</th>
                          </tr>
                        </thead>
                        <a href="#"></a>
                        <tbody>
                      @foreach ($waitting as $wait)
                        <tr>
                          {{-- <td>{{$wait->id}}</td> --}}
                          <td>{{$wait->nom}} {{$wait->pre}}</td>
                          <td>{{$company->find($wait->com)->name}}</td>
                          <td>{{$wait->en}}</td>
                          {{-- <td>ou may add Defense day</td> --}}
                          <td style="text-align:center"><a href="dashboard/{{$wait->id}}/acc" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a></td>
                          <td style="text-align:center"><a style="color:#f26058" href="dashboard/{{$wait->id}}/ref"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    @else
                      <h4>You have no stage demmande</h4>
                    @endif
              </div>
            </div>
          </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="bleu">
                        <h4 class="title">tableau de bord </h4>
                        <p class="category">Last news</p>
                    </div>
                      <div class="card-content table-responsive">
                      <h2>Nouvelle <small></small></h2>
                      </div>

                </div>
              </div>
              {{-- Stage sont ecdareur --}}
                        <div class="col-lg-8 col-md-12">
                          <div class="card">
                            <div class="card-header" data-background-color="bleu">
                              <h4 class="title">Stage sans encadreur</h4>
                              <p class="category">nombre de satges</p>
                            </div>
                            <div class="card-content table-responsive">
                                  @if (count($sans)>0)
                                    <table class="table table-hover">
                                      <thead class="text-warning">
                                        <tr>
                                          <th>Student Name</th>
                                          <th>Company</th>
                                          <th>Company framer</th>
                                          <th>information</th>
                                          <th>Accept</th>
                                        </tr>
                                      </thead>
                                      <a href="#"></a>
                                      <tbody>
                                    @foreach ($sans as $wait)
                                      <tr>
                                        {{-- <td>{{$wait->id}}</td> --}}
                                        <td>{{$wait->nom}} {{$wait->pre}}</td>
                                        <td>{{$company->find($wait->com)->name}}</td>
                                        <td>{{$wait->en}}</td>
                                        {{-- <td>ou may add Defense day</td> --}}
                                        <td style="text-align:center"><a href="dashboard/{{$wait->id}}/acc"><i class="fa fa-search-plus" aria-hidden="true"></i></a></td>
                                        <td style="text-align:center"><a style="color:green" href="dashboard/{{$wait->id}}/encadre"><i class="fa fa-check" aria-hidden="true"></i></a></td>
                                      </tr>
                                    @endforeach
                                    </tbody>
                                  </table>
                                  @else
                                    <h4>You have no stage demmande </h4>
                                  @endif
                            </div>
                          </div>
                        </div>
        </div>
    </div>
    </div>

    <!-- modal show students -->
    <div class="modal fade" tabindex="-1" role="dialog" id="info">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">information</h4>
          </div>
          <div class="modal-body">

          </div>
        </div>
      </div>
    </div>




@endsection
