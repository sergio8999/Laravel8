<div class="dashboard">
    <!--barra navegación-->
    <nav id="sideNav" class="navbar fixed-top navbar-expand-lg navbar-dark bg-aside"> 

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
         <div class="collapse navbar-collapse d-lg-flex align-items-center flex-column" id="navbarNavAltMarkup">
    
        <h4 id="title-dashboard" class="text-light mt-5">Dashboard</h4>
        <ul id="extension-aside" class="nav flex-column align-items-start">
            <li class="nav-item">
                <a href="{{route('administrador.home')}}" class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-home mr-2"></i> Home</a>
            </li> 
            <li class="nav-item">
                <a href={{ route('dashboard.houses')}} class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-warehouse mr-2"></i> Alojamientos</a>
            </li>   
        </ul>
        <ul id="icon-aside" class="nav flex-column align-items-start d-none">
            <li class="nav-item">
                <a href="{{route('administrador.home')}}" class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-home"></i></a>
            </li> 
            <li class="nav-item">
                <a href={{ route('dashboard.houses')}} class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-warehouse"></i></a>
            </li>    
        </ul>            
         </div>
    </nav>
</div>