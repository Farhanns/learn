<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>

  </form>
  <ul class="navbar-nav navbar-right">
    <li>
      <a href="#" class="nav-link nav-link-lg nav-link-user">
        <img alt="image" src="https://ui-avatars.com/api/?background=fff&color=0D8ABC&bold=true&name={{ Auth::user()->nama }}" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">Hello, {{ Auth::user()->nama }}</div>
      </a>
    </li>
    <li>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-link link-danger" title="Logout" data-toggle="tooltip">
          <i class="fas fa-sign-out-alt" style="color: red;"></i>
        </button>
      </form>
    </li>
  </ul>
</nav>
