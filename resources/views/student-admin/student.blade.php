@extends('../layouts/app')

@section("content")
<div class="container">
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
        <center><div class="col-lg-12">
            {{$students->links()}}
        </div></center>
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
