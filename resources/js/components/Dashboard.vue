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
                <ul class="nav flex-column align-items-start">
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-home mr-2 lead"></i> Home</router-link>
                    </li> 
                    <li class="nav-item">
                        <router-link to="/dashboard/addHouse" class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-plus mr-2 lead"></i> Nueva casa</router-link>
                    </li>  
                    <li class="nav-item">
                        <router-link to="/dashboard/editHouses" class="nav-link d-lg-flex justify-content-center align-items-center"><i class="fas fa-edit mr-2 lead"></i> Editar casa</router-link>
                    </li>  
                </ul>
                <button class="btn bg-dark text-light logout" @click="logoutAdministrador"><i class="fas fa-sign-out-alt lead"></i> Cerrar sesión</button>
            </div>
        </nav>
        <!-- <div class="content">
            <div class="container">
                 <div value=index v-if="content == 'home'">
                    <h1 class="text-center">Bienvenido al panel de admnistrador!</h1>
                    <h3 class="mt-5">¿Que desea hacer?</h3>
                    <div class="d-flex align-items-center p-2 select" value="addHouse" @click="changeContent">
                        <span value="addHouse" @click="changeContent"><i class="fas fa-plus mr-2 lead"></i></span>
                        <p class="m-0" value="addHouse" @click="changeContent">Añadir nueva casa</p>
                    </div>
                    <div class="d-flex align-items-center p-2 select" value="editHouse" @click="changeContent">
                        <span value="editHouse" @click="changeContent"><i class="fas fa-edit mr-2 lead"></i></span>
                        <p class="m-0" value="editHouse" @click="changeContent">Editar casa</p>
                    </div>
                </div>
                <AddHouse v-if="content == 'addHouse'" />

                <div class="d-flex flex-column" v-if="content == 'editHouse'">
                    <h1 class="text-center">Casas</h1>
                    
                    <div class="row mt-3 p-3 houses d-flex justify-content-center align-items-center" v-for="house in houses" :key="house.id">
                        <div class="col-3">
                            <img :src="`/storage/${house.url}`" :alt="house.name">
                        </div>
                        <div class="col-6">
                            <h3 class="text-center">{{house.name}}</h3>
                        </div>
                        <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                            <button class="btn"><i class="fas fa-edit mr-2 lead"></i></button>
                            <button class="btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div> 
   
            </div>
        </div> -->
        <div class="content">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
        
    </div>  
</template>

<script>
import AddHouse from '../views/AddHouse.vue'
import { useStore } from 'vuex'
import router from "@/router"



export default ({
    name:'Dashboard',
    components:{
        AddHouse
    },
    setup() {
        const store = useStore();
  /*       const content = ref('home'); */

        /* const changeContent = (e)=>{
            content.value = e.target.attributes.value.nodeValue;
        } */

       const logoutAdministrador = ()=>{
            store.state.administrador = false;
            sessionStorage.removeItem('administrador');
            router.push('/administrador');
        }

        return { logoutAdministrador };
    }
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';

    .dashboard{
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

            .logout{
                @media (min-width: 992px){
                    margin-top: 35rem;
                }
            }
    }

    .content{
        width: 100%;
        min-height: 100vh;
        margin-top: 3rem;
        background-color: #c5c5dc;
        @media (min-width: 992px){
            width: auto;
            margin-left: 15rem;
            margin-top: 0;
        }
        
        p{
            font-size: 1.5rem;
        }

        .select{
            width: 20rem;
            cursor: pointer;
            transition: all .3s ease;

            &:hover{
                color: $color-blue;
            }
        }        
    }     
}

</style>