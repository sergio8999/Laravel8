<template>
    <div>
        <form @submit.prevent="login">
            <!-- <input type="hidden" name="_token" v-bind:value="csrf"> -->
        <label for="email">Email:
            <br>
            <input type="email" id="email" name="email" v-model="form.email">
        </label>

        <br>
        <label for="password">Password:
            <br>
            <input type="password" id="password" name="password" v-model="form.password">
        </label>

        <br>
        <input  type="submit" name="enviar" value="enviar">
        </form>
    </div>
    <button @click="user">User</button>
    <button @click="logout">Cerrar Sesion</button>
</template>

<script>
import axios from 'axios'
import { useStore } from 'vuex'
export default ({
    name:'TheLogin',
    data(){
        return {
            form : {
                email:"",
                password:"",
            },
            information: []
            //csrf token
            /* csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') */
        }
        },
        // cambiar esto
        setup(){ 
            const store = useStore();
            const login = ()=>{
                store.dispatch('login',_this.form);
            };

            return {login};
        },
        methods:{

            /* async login() {
                try {
                    let res = await axios.post('/api/login',this.form)
                    this.information = await res.data;
                    console.log(res.data);
            
                } catch (e) {
                    console.log(e.response) 
                }
            }, */
            async user() {
                try {
                    
                    let res = await axios.get('/api/user',{headers: {Authorization: 'Bearer ' + this.information.access_token}});
                    console.log(res.data);
                    

                } catch (e) {
                    console.log(e.response) 
                }
            },
            async logout() {
                try {
                    let res = await axios.get('/api/logout',{headers: {Authorization: 'Bearer ' + this.information.access_token}})
                    console.log(res.data);

                } catch (e) {
                    console.log(e.response) 
                }
            }
            
        },    
    components:{
        
    }
})
</script>
