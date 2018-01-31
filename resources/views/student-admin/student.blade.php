@extends('../layouts/app')

@section("content")
<div class="container">
    <div class="row">
        <div class="form-group">
            <label>Filter avec le statu de l'etudiant</label>
            <select id="student_filter" class="form-control">
            <option value="all">All</option>
            <option value="waiting">En attente</option>
            <option value="accepted">Acceptées</option>
            <option value="rejected">Refusées</option>
            </select>
        </div>
    
    </div><br>
    <div class='row'>
        @foreach($students as $student)
            <div class="student col-lg-3" id="{{ $student['id'] }}">
                <div class="text-center">
                    <h3>{{ $student['firstname'] }} {{ $student['lastname'] }}</h3>
                </div><hr>
                <div class="info-student">
                    <ul class="items">
                        <li>Cin : {{ $student['cin'] }}</li>
                        <li>Email :  {{ $student['email'] }}</li>
                        <li>Date of birth : {{ $student['birthdate'] }}</li>
                        <li class="{{ $student['state'] }}">Statu: {{ $student['state'] }} </li>
                        <li id="groups_show"></li>
                    </ul>
                </div>
                <div class="actions">
                    <a href="Show_blade_update_student/{{$student['id']}}">
                        <button class="btn btn-primary update_student">Update</button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- modal show groups -->
<div class="modal fade" tabindex="-1" role="dialog" id="show_groups">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">List of groups and sessions<span id="group_name"></span></h4>
        </div>
        <div class="modal-body">

        </div>
        </div>
    </div>
</div>
<script>

</script>
@endsection
