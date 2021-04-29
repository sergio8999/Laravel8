<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav ">
        <router-link class="navbar-brand" to="/">Logo</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link class="nav-link" to="/">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/houses">Alojamientos</router-link>
                </li>
                <li class="nav-item ">
                    </li>
                <li class="nav-item ">
                    <router-link class="nav-link" to="/login" v-if="!loggedIn">Login</router-link>
                </li>
                <li class="nav-item ">
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
    </nav>
</template>

<script>
import { useStore } from 'vuex'
import {computed} from 'vue'

export default ({
    name:'TheHeader',
    data(){
        return {
                
        }
    },
    setup() {
        const store = useStore();

        const loggedIn = computed(()=> store.state.loggedIn);
        const logout = ()=>{
            store.dispatch('logout');
            sessionStorage.removeItem('informationLogin');
            sessionStorage.removeItem('loggedIn');
            sessionStorage.removeItem('informationUser');
            sessionStorage.removeItem('filter');
        }
        return {loggedIn,logout};
    },
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';
    .bg-nav{
        background-color: black;
    } 
</style>