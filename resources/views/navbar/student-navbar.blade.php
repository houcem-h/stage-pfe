<nav class="navbar  navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Profile</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            Setting
        </a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{route('edit_profile')}}" style="color:black!important">
						<i class="fa fa-wrench"></i> Profile
          </a>
					<div class="divider"></div>
          <a class="dropdown-item" href="{{route('edit_email')}}" style="color:black!important">
					  <i class="fa fa-wrench"></i> Edit email
          </a><br>
          <a class="dropdown-item" href="{{ route('edit_password') }}" style="color:black!important">
					  <i class="fa fa-wrench"></i> Edit password
          </a>
				</div>
			</li>
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
