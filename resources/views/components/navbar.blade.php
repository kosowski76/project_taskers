<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container">

    <a class="navbar-brand" href="{{ route('home') }}">Project Taskers - Shortly Tasks</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav ml-auto mr-0">
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            Zadania
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li class="nav-item">
              <a class="dropdown-item" href="{{ route('staff.tasks.index', ['type' => Task::getStatus('Active')]) }}">
                Aktywne</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" href="{{ route('staff.tasks.index', ['type' => Task::getStatus('Completed')]) }}">
                Zakończone</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('staff.tasks.add') }}">
                  Dodaj nowe zadanie</a></li>            
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            Zalogowany jako: <b>{{ auth()->user()->name }}</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div>
              <hr class="dropdown-divider">
            </div>
            <a class="dropdown-item">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-sm">
                  Wyloguj</button>
              </form>
            </a>
          </div>
        </li> 
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            Dołącz do serwisu 
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('login') }}">              
                  Zaloguj się
            </a>
            <a class="dropdown-item" href="{{ route('register') }}">              
                  Zarejestruj się
            </a>
          </div>
        </li>
        @endauth
      </ul>

    </div>

  </div>
</nav>