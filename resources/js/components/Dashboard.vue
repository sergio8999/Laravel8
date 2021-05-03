<template>
    <div class="dashboard">
        <!--barra navegación-->
        <nav id="sideNav" class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark"> 
            <h4 class="d-lg-none text-light">Dashboard</h4>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
             <div class="collapse navbar-collapse d-lg-flex flex-column" id="navbarNavAltMarkup">
                <h4 class="d-lg-block d-none text-light">Dashboard</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-lg-flex justify-content-center align-items-center" href="#"><i class="fas fa-plus mr-2 lead"></i> Nueva casa</a>
                    </li>  
                    <li class="nav-item">
                      <a class="nav-link d-lg-flex justify-content-center align-items-center" href="#"><i class="fas fa-edit mr-2 lead"></i> Editar casa</a>
                    </li>  
                    <li class="nav-item">
                      <a class="nav-link d-lg-flex justify-content-center align-items-center" href="#">Nueva casa</a>
                    </li> 
                </ul>
            </div>
        </nav>
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sergio
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <router-link class="dropdown-item" to="/administrador" @click="logoutAdministrador"> Cerrar sesión</router-link>

                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>   
        </div>
    </div>  
</template>

<script>
import { ref, onMounted } from 'vue'
import { useStore } from 'vuex'


export default ({
    name:'Dashboard',
    setup() {
         const store = useStore();

        onMounted(()=>{
            if(sessionStorage)
                if(sessionStorage.getItem('administrador') != undefined)
                    store.state.administrador = true;
        })

        const logoutAdministrador = ()=>{
            store.state.administrador = false
            sessionStorage.removeItem('administrador');
        }

		return { logoutAdministrador }
    },
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';

    .dashboard{
        font-family: inherit;
        font-size: inherit;
        color: inherit;
        background-color: inherit;
        overflow-x: hidden;
        overflow-y: scroll;
        position:relative;   

        svg{
            width: 1.2rem;
        }

        #sideNav {

            @media (min-width: 992px) {
        
                text-align: center;
                position: fixed;
                display: flex;
                flex-direction: column;
                width: 15rem;
                height: 100vh;   
                
                .navbar-collapse{
                display: flex;
                align-items: flex-start;
                flex-grow: 0;
                width: 100%;
                margin-bottom: auto;
                margin-top: 12vh;

                .navbar-nav{
                    flex-direction: column;
                    width: 100%;
                    display: block;

                    .nav-link{
                        display: block;
                    }
                }
            }
            }
    }

    .content{
        width: 100%;
        min-height: 100vh;
        @media (min-width: 992px){
            width: auto;
            margin-left: 15rem;
        }
        
    }     

}



</style>