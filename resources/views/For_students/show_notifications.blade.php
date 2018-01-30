@extends('../layouts/dashboard')

@section("content")
<div class="content-wrapper">
    <div class="container">
        @if(count($teachers) > 0)
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">
                        Demandes d'encadrement
                    </h4>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom de l'enseignant</th>
                            <th>Type de stage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="requests">
                        @foreach($teachers as $teacher)
                            <tr id="{{ $teacher->id }}">
                                <td>{{ $teacher->firstname }} {{ $teacher->lastname }}</td>
                                <td>{{ $teacher->type }}</td>
                                <td class="actions">
                                    <button class="btn btn-success accept">Accepter</button>
                                    <button class="btn btn-danger decline">Refuser</button>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h2>Aucun notifications</h2>
        @endif
    </div>
</div>
@endsection