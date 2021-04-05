<template>
    <div>
        <h1>Pagina de registro:</h1>
        <form @submit.prevent="signUp">
            <label for="name">Nombre:
            <br>
            <input type="text" id="name" name="name" v-model="name" placeholder="Nombre">
        </label>

        <br>
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
import useSignUp from '@/composables/useSignUp'
import { ref } from 'vue'
export default ({
    name:'SignUp',
    data(){
        return {
            
        }
    },
    setup(){
        const name =ref('');
        const email =ref('');
        const password =ref('');

        const { signUp } = useSignUp(name,email,password);

        return {signUp, name, email, password};
    },
    methods:{
            
    },    
    components:{
        
    }
})
</script>
