<template>
    <div>
        <h1>Pagina de login:</h1>
        <form @submit.prevent="login">
        <label for="email">Email:
            <br>
            <input type="email" id="email" name="email" v-model="email" placeholder="Email">
        </label>

        <br>
        <label for="password">Password:
            <br>
            <input type="password" id="password" name="password" v-model="password" placeholder="Password">
        </label>

        <br>
        <input  type="submit" name="enviar" value="enviar">
        </form>
    </div>
</template>

<script>
import { ref } from 'vue'
/* import useLogin from '../composables/useLogin' */
import useLogin from '@/composables/useLogin'

export default ({
    name:'TheLogin',
    data(){
        return {
    
        }
    },
    setup(){ 
        const email =ref('');
        const password =ref('');

        const { login } = useLogin(email,password);

        return {login, email, password};
    },
    methods:{
        
            
    },    
    components:{
        
    }
})
</script>
