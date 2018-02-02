
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Stages & PFE</a>
      </div>
      <ul class="nav navbar-nav">
        <li ><a href="../teacherhome"><i class="icon-home"></i> Acceuil</a></li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-share"></i> Groupe<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a  href="{{route('group')}}">Liste des groups</a></li>
            <li><a href="{{route('show_blade_add')}}" >Ajouter un groupe</a></li>
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-people"></i> Etudiants<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('show_all_students')}}">Liste des etudiants</a></li>
            <li><a href="{{route('add_student')}}">Ajouter un etudiant</a></li>
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-notebook"></i> Enseignants<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('teachers')}}">Liste des enseignants</a></li>
            <li><a href="{{'teachers/create'}}">Ajouter un enseignant</a></li>
          </ul>
        </li>

        <li ><a href="{{route('settings')}}"><i class="icon-settings"></i> Parametres</a></li>




      </ul>




      <ul class="nav navbar-nav navbar-right">
          <li><a class="btn btn-grey" style="pointer:cursor" href="../dashboard"><i class="icon-briefcase"></i> Connecter En Tant Qu'Admin</a></li>
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
    </div>
  </nav>