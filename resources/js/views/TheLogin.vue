<template>

    <!-- Modal términos-->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">Terminos de condiciones </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius impedit reprehenderit quos voluptates delectus dicta iusto quae magni aperiam ullam quo enim laudantium nam rem, esse tempore nostrum similique ipsam.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal privacidad-->
        <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="privacyModalLabel">Politica de privacidad </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius impedit reprehenderit quos voluptates delectus dicta iusto quae magni aperiam ullam quo enim laudantium nam rem, esse tempore nostrum similique ipsam.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    <div class="d-flex flex-column align-items-center justify-content-center">
        <h1 class="text-center my-3">Inicie sesión:</h1>
        <form @submit.prevent="login">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email" placeholder="Introduce email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="password" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn btn-dark btn-size" :disabled="disabledButton">Login</button>
        </form>
        <span class="my-3">o usa una de estas opciones</span>
        <div class="social-network d-flex justify-content-around">
            <span><i class="pi pi-facebook" v-tooltip="'Facebook'"></i></span>
            <span><i class="pi pi-twitter" v-tooltip="'Twitter'"></i></span>
            <span><i class="pi pi-google" v-tooltip="'Google'"></i></span>
        </div>
        
        <div class="terms">
            <hr>
            <p class="text-center">Al iniciar sesión, acepta nuestros <span data-toggle="modal" data-target="#termsModal">Términos y condiciones</span> y la <span data-toggle="modal" data-target="#privacyModal">Politica de privacidad</span></p>
            <hr>
            <p class="ml-4">&copy; Copyrigth</p>
        </div>
    </div>
</template>

<script>
import { computed, onMounted, ref } from 'vue'
/* import useLogin from '../composables/useLogin' */
import useLogin from '@/composables/useLogin'
import { useStore } from 'vuex'
import { getLogin } from '@/utils/checkLogin'

export default ({
    name:'TheLogin',
    data(){
        return {
    
        }
    },
    setup(){ 
        const store = useStore();
        const email = ref('');
        const password = ref('');


        onMounted(()=>{
            getLogin();
        });

        const disabledButton = computed(()=>store.state.disabledButton);
    
        const { login } = useLogin(email,password);

        return { login, email, password, disabledButton };
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