<template>
    <div>
        <h1>Pagina de login:</h1>
        <form @submit.prevent="login">
        <label for="email">Email:
            <br>
            <input type="email" id="email" name="email" v-model="email">
        </label>

        <br>
        <label for="password">Password:
            <br>
            <input type="password" id="password" name="password" v-model="password">
        </label>

        <br>
        <input  type="submit" name="enviar" value="enviar">
        </form>
    </div>
</template>

<script>
import { useStore } from 'vuex'
import { ref } from 'vue'

export default ({
    name:'TheLogin',
    data(){
        return {
    
        }
    },
    setup(){ 
        const store = useStore();
        const email =ref('');
        const password =ref('');
    
        const login = async ()=>{
            try{
                await store.dispatch('login',{'email':email.value,'password':password.value});
                /*this.$router.push('/'); */
            }catch(e){
                console.log(e);
            }
        };

        return {login,email,password};
    },
    methods:{

            
    },    
    components:{
        
    }
})
</script>
