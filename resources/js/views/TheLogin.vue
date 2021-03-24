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
</template>

<script>
import axios from 'axios'
export default ({
    name:'TheLogin',
    data(){
        return {
            form : {
                email:"",
                password:"",
                information: []
            }
            //csrf token
            /* csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') */
        }
        },
        methods:{

            async login() {
                try {
                let res = await axios.post('/api/login',this.form)
                .then(response => {
                    console.log(response.data);
                    information = response.data;
                    this.$router.push('/');
                })

            } catch (e) {
                 console.log(e.response) // undefined
            }
        }
        },    
    components:{
        
    }
})
</script>
