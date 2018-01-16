@extends('../layouts/app')
@section("content")
  <div class="container">
    <div class="row">
    <a href="{{route('group')}}">
        <button class="btn btn-default" style="width:100px">Back</button>
    </a></div>
    <div class="form col-lg-6 col-lg-offset-3">
      <div class="text-center">
        <h2>Add group</h2>
      </div>
      <form action="{{ route('add_group') }}" method="POST">
          {{ csrf_field() }}
        <div class="form-group name_add_err">
            <label>Name :</label>
            <input type="text" name="name" value="" class="form-control input-lg" placeholder="Choose a name,exemple: TI11,RSI22..."
            id="add_name">
            <span class="text-danger" id="name_span_add_err"></span>
        </div>
        <div class="form-group">
            <label>Stream :</label>
            <input type="text" name="stream" class="form-control input-lg" id="stream" disabled>
        </div>
        <div class="form-group">
          <a href="save_updated_group">
            <input type="submit" class="btn btn-primary btn-group-justified" value="Add" id="add"></button>
          </a>
        </div>
      </form>
    </div>
  </div>
  <script>
  </script>
@endsection
