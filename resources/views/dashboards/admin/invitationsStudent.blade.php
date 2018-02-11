@extends('dashboards.admin.appdash')


@section('dash_content')
<br>
@if(count($students) > 0)
<input type="checkbox" id="selectAll"> Selectioner tout<br>
<button class="btn btn-primary" id="acceptChecked" disabled>Accepter</button>
<button class="btn btn-danger" id="deleteChecked" disabled>Refuser</button>
<br><br>
<table class="table table-hover">
    <thead>
        <th></th>
        <th>Nom de l'etudiant</th>
        <th></th>
    </thead>

    <tbody>
        @foreach($students as $student)
            <tr id="{{ $student->registrationId }}" class="{{ $student->userId }}" userEmail="{{ $student->email }}">
                <td><input type="checkbox" class="checkbox"></td>
                <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                <td style="text-align:right">
                    <button class="btn btn-success acceptStudentInvit">Accepter</button>
                    <button class="btn btn-danger deleteStudentInvit">Refuser</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <h2>Aucune invitations</h2>
@endif
@endsection