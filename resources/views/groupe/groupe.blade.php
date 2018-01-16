@extends('../layouts/app')

@section("content")
<div class="container">
  <div class="row">
    @foreach ($groups as $group)
        <div class="group col-lg-3" id="{{ $group->id }}">
          <div class="text-center">
            <h2>{{ $group->name}}</h2>
          </div><hr>
          <div class="informations">
            <p>Stream : {{ $group->stream }}</p>
            <p>Created at: {{ $group->created_at }}</p>
            <p>Updated at :{{ $group->updated_at }}</p>
            @if($group->created_by != NULL)
              <p>Created by :{{ $group->created_by }}</p>
            @endif
            @if($group->updated_by != NULL)
              <p>Updated by :{{ $group->updated_by }}</p>
            @endif

            <a href="" data-toggle="modal" data-target="#show_student" class="toggle-modal-show">Show students</a>
          </div>
          <div class="actions">
            <a href="Show_blade_update/{{$group->id}}">
                <button class="btn btn-primary update_group">Update</button>
            </a>
                <button class="btn btn-danger delete_group" id="{{ $group->id }}">Delete</button>
          </div>
        </div>
    @endforeach
    <center><div class="col-lg-12">
      {{$groups->links()}}
    </div></center>
  </div>
</div>

<!-- modal show students -->
<div class="modal fade" tabindex="-1" role="dialog" id="show_student">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">List of students in <span id="group_name"></span></h4>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
<script>

  var token = "{{ Session::token() }}";
</script>
@endsection
