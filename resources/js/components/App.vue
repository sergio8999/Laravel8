<template>
    <Toast position="top-center"/>
    <div>
        <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/">Home</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/login" v-if="!loggedIn">Login</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/signUp" v-if="!loggedIn">Registrar</router-link>
                    </li>
                    <li class="nav-item dropdown" v-if="loggedIn">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Usuario
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <router-link class="dropdown-item" to="/user">Perfil</router-link>
                            <router-link class="dropdown-item" to="/" @click="logout">Cerrar sesión</router-link>
                        </div>
                    </li>
                </ul>
            </div>
        </nav> -->
        <nav>
            <ul class="menu">
                <li>
                    <router-link class="nav-link" to="/">Home</router-link>
                </li>
                <li>
                    <router-link class="nav-link" to="/home">Alojamientos</router-link>
                </li>
                <li>
                    <router-link class="nav-link" to="/login">icono login</router-link>
                </li>
            </ul>
        </nav>
        <router-view></router-view>      
    </div>
</template>

<script>
import { useStore } from 'vuex'
import {computed} from 'vue'

export default ({
    
    name:'App',
    data(){
        return {
                
        }
    },
    setup(){
        const store = useStore();

        const loggedIn = computed(()=> store.state.loggedIn);
        const logout = ()=>{
            store.dispatch('logout');
        }
        return {loggedIn,logout};
    },
    
    components:{

    },
    methods:{

    },
    mounted(){
            
        }
})
</script>
