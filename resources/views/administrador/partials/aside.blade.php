<div class="dashboard">
    <!--barra navegación-->
    <nav id="sideNav" class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark"> 
        <h4 class="d-lg-none text-light">Dashboard</h4>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
         <div class="collapse navbar-collapse d-lg-flex flex-column" id="navbarNavAltMarkup">
            <h4 class="d-lg-block d-none text-light">Dashboard</h4>
            <ul class="nav flex-column align-items-start">
                <li class="nav-item">
                    <a href="{{route('administrador.index')}}" class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-home mr-2"></i> Home</a>
                </li> 
                <li class="nav-item">
                    <a href={{ route('dashboard.houses')}} class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-warehouse mr-2"></i> Alojamientos</a>
                </li>  
            </ul>
            <a href="{{route('dashboard')}}" class="btn bg-dark text-light logout" ><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
        </div>
    </nav>