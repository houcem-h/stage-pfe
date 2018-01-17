<nav class="navbar  navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">CRUD</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{route('group')}}">Group list</a></li>
      <li><a href="{{route('show_blade_add')}}">Add group</a></li>
      <li><a href="{{route('show_all_students')}}">List of students</a></li>
      <li>
         <a href="{{ route('logout') }}"
             onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                 Logout
         </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             {{ csrf_field() }}
         </form>
      </li>
    </ul>
    </div><!-- /.navbar-collapse -->
  </div>
</nav>
