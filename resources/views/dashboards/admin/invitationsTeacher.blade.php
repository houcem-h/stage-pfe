@extends('dashboards.admin.appdash')


@section('dash_content')
<br>
@if(count($teachers) > 0)
<input type="checkbox" id="selectAllTeacher"> Selectioner tout<br>
<button class="btn btn-primary" id="acceptCheckedTeacher" disabled>Accepter</button>
<button class="btn btn-danger" id="deleteCheckedTeacher" disabled>Refuser</button>
<br><br>
<table class="table table-hover">
    <thead>
        <th></th>
        <th>Nom de l'enseignant</th>
        <th></th>
    </thead>

    <tbody>
        @foreach($teachers as $teacher)
            <tr id="{{ $teacher->id }}" userEmail="{{$teacher->email}}">
                <td><input type="checkbox" class="checkboxTeacher"></td>
                <td>{{ $teacher->firstname }} {{ $teacher->lastname }}</td>
                <td style="text-align:right">
                    <button class="btn btn-success acceptTeacherInvit">Accepter</button>
                    <button class="btn btn-danger deleteTeacherInvit">Refuser</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <h2>Aucune invitations</h2>
@endif
@endsection