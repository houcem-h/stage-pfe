@extends('../layouts/app')
<!-- Enseignat should connect to his account to set the field "updated BY"-->
@section("content")
  <div class="container">
    <div class="row">
    <a href= "{{ URL::previous() }}">
        <button class="btn btn-default" style="width:100px">Back</button>
    </a></div>
    <div class="form_update col-lg-6 col-lg-offset-3">
      <div class="text-center">
        <h2>Update group</h2>
      </div>
      <form action="" method="POST">
          {{ csrf_field() }}
        <div class="form-group">
            <label>Id group :</label>
            <input type="text" name="id_group" value="{{$group->id}}" class="form-control" disabled id="id_group">
        </div>
        <div class="form-group" id="Nom_up_err">
            <label>Name :</label>
            <input type="text" name="name" value="{{$group->name}}" class="form-control" id="nom_update">
            <span class="text-danger" id="nom_span_err"></span>
        </div>
        <div class="form-group">
            <label>Stream</label>
            <input type="text" value="{{ $stream }}" class="form-control" name="stream" id="stream_update" disabled>
        </div>
        <small class="text-danger danger">All fields are required</small>
        <div class="form-group">
          <a href="save_updated_group">
            <input type="submit" class="btn btn-primary btn-group-justified" value="Save" id="save_group"></button>
          </a>
        </div>
      </form>
    </div>
  </div>
  <script>

  </script>
@endsection
