<nav class="navbar  navbarteach  ">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Bienvenue  {{auth()->user()->lastname}}</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{route('teacherhome')}}">Accueil</a></li>
      {{-- still working one  --}}
      <li><a href="{{route('calendar')}}">Calendrier</a></li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Paramètre <span class="caret"></span></a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @if (auth()->user()->role==2)
              <li><a href="{{route('settings')}}">Information</a></li>
            @endif
            <li><a href="{{route('settings')}}">Information</a></li>
            <li><a href="{{route('settingspass')}}">Mot de passe</a></li>
          </ul>
        </li>
        @if (auth()->user()->role == "2") 
        <li>
          <a class="btn btn-primary" href="./dashboard/">Connecter en tant qu'Admin</a>
        </li>
        @endif
      <li>
         <a href="{{ route('logout') }}"
             onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                 Déconnecter
         </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             {{ csrf_field() }}
         </form>
      </li>
    </ul>
    </div><!-- /.navbar-collapse -->
  </div>
</nav>
