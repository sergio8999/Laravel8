<template>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <h1 class="text-center my-3">Crea una cuenta:</h1>
        <form @submit.prevent="signUp">
            <div class="form-group">
                <label for="exampleInputName1">Nombre</label>
                <input type="text" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" v-model="name" placeholder="Introduce nombre">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email" placeholder="Introduce email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="password" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn btn-dark btn-size" :disabled="disabledButton">Sign up</button>
        </form>
        <span class="my-3">o usa una de estas opciones</span>
        <div class="social-network d-flex justify-content-around">
            <span><i class="pi pi-facebook" v-tooltip="'Facebook'"></i></span>
            <span><i class="pi pi-twitter" v-tooltip="'Twitter'"></i></span>
            <span><i class="pi pi-google" v-tooltip="'Google'"></i></span>
        </div>
        
        <div class="terms">
            <hr>
            <p class="text-center">Al crear cuenta, acepta nuestros <span>Términos y condiciones</span> y la <span>Politica de privacidad</span></p>
            <hr>
            <p class="ml-4">&copy; Copyrigth</p>
        </div>
    </div>
</template>

<script>
import useSignUp from '@/composables/useSignUp'
import { computed, onMounted, ref } from 'vue'
import { useStore } from 'vuex'
import { getLogin } from '@/utils/checkLogin'


export default ({
    name:'SignUp',
    data(){
        return {
            
        }
    },
    setup(){
        const store = useStore();
        const name =ref('');
        const email =ref('');
        const password =ref('');

        onMounted(()=>{
            getLogin();
        });

        const disabledButton = computed(()=>store.state.disabledButton);
        const { signUp } = useSignUp(name,email,password);

        return { signUp, name, email, password, disabledButton };
    },
    methods:{
            
    },    
    components:{
        
    }
})
</script>

<style scoped lang="scss">

    @import '../../scss/app.scss';

    form{
        width: 90%;

        @media (min-width: 960px) {
            width: 30%;
        }
        
        .btn-size{
        width: 100%;
        }
    }

    .social-network{
        width: 90%;

        @media (min-width: 960px) {
            width: 30%;
        }

        span{
            display: flex;
            justify-content: center;
            align-items: center;
            i{
                cursor: pointer;
                font-size: 2.5rem;
            }
        }
    }

    .terms{
        width: 90%;

        @media (min-width: 960px) {
            width: 30%;
        }

        span{
            color: $color-blue;
            cursor: pointer;
        }
    }

</style>