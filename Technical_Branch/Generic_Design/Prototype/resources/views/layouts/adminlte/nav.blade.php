<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    {{-- <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <span class="">Ayoub  <i class="right fas fa-angle-down"></i> </span>
      </a>
      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          Profil
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
        se déconnecter
        </a>
      </div>
    </li> --}}

    <!-- Settings Dropdown -->
    @if(Auth::check())
<div class="d-none d-sm-flex align-items-center ms-3">
  <div class="dropdown">
      <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          {{ Auth::user()->name }}
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <li>
              <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
          </li>
          <li>
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
              </form>
          </li>
      </ul>
  </div>
</div>

<!-- Hamburger (Mobile Nav Toggle) -->
<div class="d-sm-none">
  <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-expanded="false" aria-controls="mobileMenu">
      <span class="navbar-toggler-icon"></span>
  </button>
</div>
@endif

  </ul>
</nav>