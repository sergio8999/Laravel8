<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between py-0">
      <ul class="navbar-nav">
        <li class="nav-item" id="collapseAside" collapse="false">
          <a  class="btn d-lg-block d-none"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav d-flex flex-row mt-2">
        <li class="nav-item d-flex justify-content-center align-items-center">
            <a class="btn"><i class="far fa-bell"></i></a>
        </li>
        <li class="nav-item d-flex justify-content-center align-items-center">
            <a class="btn"><i class="far fa-envelope"></i></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div>
                <img class="avatar" src="/storage/avatar.jpg" alt="avatar">
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item logout" href="{{route('dashboard.logout')}}"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
          </div>
        </li>
      </ul>
  </nav>

@push('head')
<script src="{{ asset('js/components/addHouse.js')}}"></script>
@endpush