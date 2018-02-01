@extends('../layouts/dashboard')

@section("content")
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Liste des enseignants</h4>
            </div>
        </div>
        <div class="data col-md-6 col-xs-12 col-md-offset-3 ">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom de l'enseignant</th>
                        <th>Adresse email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->firstname}} {{  $teacher->lastname }}</td>
                            <td>{{ $teacher->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection