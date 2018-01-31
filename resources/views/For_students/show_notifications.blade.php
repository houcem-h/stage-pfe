@extends('../layouts/dashboard')

@section("content")
<div class="content-wrapper">
    <div class="container">
        @if(count($framing) > 0)
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
                        @foreach($framing as $frame)
                            <tr id="{{ $frame->id }}" data-intern="{{ $frame->internship}}" data-teachId="{{$frame->teacher}}">
                                <td>{{ $frame->firstname }} {{ $frame->lastname }}</td>
                                <td>{{ $frame->type }}</td>
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