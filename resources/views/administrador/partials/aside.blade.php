<div class="dashboard">
    <!--barra navegación-->
    <nav id="sideNav" class="navbar fixed-top navbar-expand-lg navbar-dark bg-aside p-0"> 

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
         <div class="collapse navbar-collapse d-lg-flex align-items-center flex-column m-lg-0" id="navbarNavAltMarkup">
            <h4 id="title-dashboard" class="ml-2 ml-lg-0 mt-5">Dashboard</h4>
            <ul id="extension-aside" class="nav flex-column align-items-start w-100 mt-lg-4">
                <li class="{{ Request::url() == url('/administrador/home') ? 'active' : '' }} nav-item bg-hover">
                    <a href="{{route('administrador.home')}}" class="nav-link d-lg-flex justify-content-center align-items-center text-light"><i class="fas fa-home mr-2"></i> Home</a>
                </li> 
                <li id="dropdown-title" class="nav-item bg-hover d-flex align-items-center text-light" dropdown="false">
                    <a class="nav-link d-lg-flex justify-content-center align-items-center text-light"><i class="fas fa-warehouse mr-2"></i> Alojamientos</a>
                    <i class="fas fa-chevron-left mr-3 tamanoIcon"></i>
                    <i class="fas fa-chevron-down mr-3 tamanoIcon d-none"></i>
                </li>   
                <ul id="dropdown-houses" class="nav flex-column align-items-start w-100 d-none bg-dropdown">
                    <li class="{{ Request::url() == url('/administrador/houses') ? 'active' : '' }} nav-item bg-hover pl-3">
                        <a href="{{route('dashboard.houses')}}" class="nav-link text-light"></i>Ver alojamientos</a>
                    </li> 
                    <li class="{{ Request::url() == url('/administrador/houses/add-house') ? 'active' : '' }} nav-item bg-hover pl-3">
                        <a href="{{route('dashboard.addHouse')}}" class="nav-link text-light"></i>Nuevo alojamiento</a>
                    </li> 
                </ul>
            </ul>
            <ul id="icon-aside" class="nav flex-column align-items-start d-none w-100 mt-5">
                <li class="nav-item bg-hover">
                    <a href="{{route('administrador.home')}}" class="nav-link d-lg-flex justify-content-center align-items-center text-light"><i class="fas fa-home"></i></a>
                </li> 
                <li class="nav-item bg-hover">
                    <a href={{ route('dashboard.houses')}} class="nav-link d-lg-flex justify-content-center align-items-center text-light"><i class="fas fa-warehouse"></i></a>
                </li>    
            </ul>            
         </div>
    </nav>
</div>