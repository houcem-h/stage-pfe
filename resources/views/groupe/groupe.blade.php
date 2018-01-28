@extends('../layouts/app')

@section("content")
<div class="container">
  <div class="row">
    <div class="form-group">
      <label>Filter avec le group</label>
      <select id="group_filter" class="form-control">
        <option value="all">All</option>
        <option value="dsi">DSI</option>
        <option value="ti">TI</option>
        <option value="rsi">RSI</option>
        <option value="sem">SEM</option>
        <option value="mdw">MDW</option>
      </select>
    </div>
    
  </div><br>
  <div class="row">
    @foreach ($groups as $group)
        <div class="group col-lg-3" id="{{ $group->id }}">
          <div class="text-center">
            <h2>{{ $group->name}}</h2>
          </div><hr>
          <div class="informations">
            <p class="{{ $group->stream }}">Stream : {{ $group->stream }}</p>
            <p>Created at: {{ $group->created_at }}</p>
            <p>Updated at :{{ $group->updated_at }}</p>
            
            <a href="" data-toggle="modal" data-target="#show_student" class="toggle-modal-show">Show students</a>
          </div>
          <div class="actions">
            <a href="{{ route('Show_blade_update', $group->id) }}">
                <button class="btn btn-primary update_group">Update</button>
            </a>
                <button class="btn btn-danger delete_group" id="{{ $group->id }}">Delete</button>
          </div>
        </div>
    @endforeach
    <center><div class="col-lg-12">
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
@endsection
