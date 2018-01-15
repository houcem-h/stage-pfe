@extends('dashboards.admin.appdash')


@section('dash_content')
<br>
    <div class="card">

        <div class="card-header">
                <i class="fa fa-edit"></i> Interships (All)
        </div>

<div class="card-body">
        <div class="row"><div class="col-sm-12">
            <table class="table table-responsive-sm table-hover table-outline mb-0" role="grid"  style="border-collapse: collapse !important">

                    <thead class="thead-light">
                            <tr>
                              <th class="text-center">Full Name</th>
                              <th class="text-center">Start Date</th>
                              <th class="text-center">End Date</th>
                              
                              <th class="text-center">Framer</th>
                              <th class="text-center">Comapny Framer</th>
                              <th class="text-center">Status</th>
                            </tr>
                          </thead>

                <tbody>
                    @for ( $i = 0 ; $i < 10 ; $i++ )
                        <tr role="row" class="odd">
                                <td class="text-center">Foulen Ben Foulen</td>
                                <td  class="text-center">2018/01/01</td>
                                <td class="text-center">2018/02/01</td>
                                <td class="text-center">Moudir ben Moudir</td>
                                <td class="text-center">STIR</td>
                                <td class="text-center">
                                    <span class="badge badge-success">Verified</span>
                                </td>
                        </tr>
                    @endfor    
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>


@endsection