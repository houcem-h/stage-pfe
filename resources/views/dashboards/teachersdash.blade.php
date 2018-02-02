<style media="screen">

</style>
@extends('layouts.app')
@section('content')
  <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="bleu">
                        <h4 class="title">Mes stage PFE</h4>
                        <p class="category">last stage added : last  {{Auth::user()->id}} </p>
                    </div>
                    <div class="card-content table-responsive">
                        {{-- les etudient valide  --}}
                        @if (count($stageencadres)==0)
                          <h4> You Dont Have </h4>
                        @else
                          <table class="table table-hover">
                            <thead class="text-warning">
                              <tr>
                                <th>ID</th>
                                <th>Étudiant<small>(e)</small></th>
                                <th>Société</th>
                                <th>Encadreur d'entreprise</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                {{-- <th>Date</th> --}}
                                <th>information</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($stageencadres as $stageencadre)
                                <tr>
                                  <td>{{$stageencadre->id}}</td>
                                  <td>{{$stageencadre->registration->studentRecord->firstname}} {{$stageencadre->registration->studentRecord->lastname}}</td>
                                  <td>{{--{{$company->find($stager->com)->name}}--}}{{$stageencadre->companyFramer->managerCompany->name}}</td>
                                  <td>{{$stageencadre->companyFramer->name}}</td>
                                  <td>{{$stageencadre->start_date}}</td>
                                  <td>{{$stageencadre->end_date}}</td>
                                  {{-- <td> Defense day</td> --}}
                                  <td  style="text-align:center"><a  id="{{ $stageencadre->id }}" data-toggle="modal" data-target="#information" class="toggle-modal-show"><i class="fa fa-search-plus" aria-hidden="true"></i></a></td>
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
        <div class="col-lg-8 col-md-8">
            <div class="card">
              <div class="card-header" data-background-color="bleu">
                <h4 class="title">Demmande d'encadremeent</h4>
                <p class="category">New employees on 15th September, 2016</p>
              </div>
              <div class="card-content table-responsive">
                    @if (count($waiting)>0)
                      <table class="table table-hover">
                        <thead class="text-warning">
                          <tr>
                            <tr>
                              <th>Étudiant<small>(e)</small></th>
                              <th>Société</th>
                              <th>Details</th>
                              <th>Accepté</th>
                              <th>Refuse</th>
                            </tr>
                          </tr>
                        </thead>
                        <a href="#"></a>
                        <tbody>
                          @foreach ($waiting as $wait)
                            <tr>
                              {{-- <td>{{$wait->id}}</td> --}}
                              <td>{{$wait->internshipRecord->registration->studentRecord->firstname}} {{$wait->internshipRecord->registration->studentRecord->lastname}}</td>
                              <td>{{$wait->internshipRecord->companyFramer->managerCompany->name}}</td>
                              {{-- <td>{{$wait->en}}</td> --}}
                              {{-- <td>ou may add Defense day</td> --}}
                              <td  style="text-align:center" ><a id="{{$wait->internshipRecord->id}}"  data-toggle="modal" data-target="#information" class="toggle-modal-show"><i class="fa fa-search-plus" aria-hidden="true"></i></a></td>
                              <td style="text-align:center"><a href="dashboard/{{$wait->internshipRecord->id}}/acc" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a></td>
                              <td style="text-align:center"><a style="color:#f26058" href="dashboard/{{$wait->internshipRecord->id}}/ref"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                    @else
                      <h4>You have no stage demmande</h4>
                    @endif
              </div>
            </div>

              {{-- Stage sont ecdareur --}}
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
                                          <th>Étudiant<small>(e)</small></th>
                                          <th>Société</th>
                                          <th>Details</th>
                                          <th>Demendé</th>
                                        </tr>
                                      </thead>
                                      <a href="#"></a>
                                      <tbody>
                                    @foreach ($sans as $wait)
                                      <tr>
                                        {{-- <td>{{$wait->id}}</td> --}}
                                        <td>{{$wait->registration->studentRecord->firstname}} {{$wait->registration->studentRecord->lastname}}</td>
                                        <td>{{$wait->companyFramer->managerCompany->name}}</td>
                                        {{-- <td>{{$wait->en}}</td> --}}
                                        {{-- <td>ou may add Defense day</td> --}}
                                        <td  style="text-align:center" ><a id="{{ $wait->id }}"  data-toggle="modal" data-target="#information" class="toggle-modal-show"><i class="fa fa-search-plus" aria-hidden="true"></i></a></td>
                                        <td style="text-align:center"><a style="color:green" href="dashboard/{{$wait->id}}/encadre"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
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
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="bleu">
                    <h4 class="title">tableau de bord </h4>
                    <p class="category">Last news</p>
                </div>
                <div class="card-content table-responsive">
                      @if (count($wishing)>0)
                        <table class="table table-hover">
                          <thead class="text-warning">
                            <tr>
                              <th>Étudiant<small>(e)</small></th>
                              <th>Details</th>
                              <th>Annuler</th>
                            </tr>
                          </thead>
                          <a href="#"></a>
                          <tbody>
                        @foreach ($wishing as $wish)
                          <tr>
                            {{-- <td>{{$wait->id}}</td> --}}
                            <td>{{$wish->internshipRecord->registration->studentRecord->firstname}} {{$wish->internshipRecord->registration->studentRecord->lastname}}</td>
                            {{-- <td>ou may add Defense day</td> --}}
                            <td  style="text-align:center" ><a id="{{$wish->internshipRecord->id}}}"  data-toggle="modal" data-target="#information" class="toggle-modal-show"><i class="fa fa-search-plus" aria-hidden="true"></i></a></td>
                            <td style="text-align:center"><a style="color:#f26058" href="dashboard/{{$wish->internshipRecord->id}}/ref"><i class="fa fa-times" aria-hidden="true"></i></a></td>
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
    </div>

  </div>

    <!-- modal show students -->
    <!-- modal show students -->
    <div class="modal fade" tabindex="-1" id="information" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">  <div class="card-content table-responsive">
                    <table class="">
                      <thead>
                      <tr>
                            <th>Information</th>
                      </tr>
                    </thead>
                  </table>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card-content table-responsive">
                    <table class="table">
                      <tbody>
                      <tr>
                        <td>Téléphone</td>
                        <td id="studentnum"></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td id="studentemail"></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">  <div class="card-content table-responsive">
                    <table class="">
                      <thead>
                      <tr>
                            <th>Encadreur d'entreprise</th>
                      </tr>
                    </thead>
                  </table>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card-content table-responsive">
                    <table class="table">
                      <tbody>
                      <tr>
                        <td>Téléphone</td>
                        <td id="managernum"></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td id="manageremail"></td>
                      </tr>
                      <tr>
                        <td>Position</td>
                        <td id="managerposition"></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-4">  <div class="card-content table-responsive">
                    <table class="">
                      <thead>
                      <tr>
                            <th>Information Stage</th>
                      </tr>
                    </thead>
                  </table>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card-content table-responsive">
                    <table class="table">
                      <tbody>
                      <tr>
                        <td>Titre</td>
                        <td id="titre"></td>
                      </tr>
                      <tr>
                        <td>existing_desc</td>
                        <td id="existing_desc"></td>
                      </tr>
                      <tr>
                        <td>requirement_spec</td>
                        <td id="requirement_spec"></td>
                      </tr>
                      <tr>
                        <td>hardware_env</td>
                        <td id="hardware_env"></td>
                      </tr>
                      <tr>
                        <td>software_env</td>
                        <td id="software_env"></td>
                      </tr>
                      <tr>
                        <td>provisional_planning</td>
                        <td id="provisional_planning"></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



@endsection
