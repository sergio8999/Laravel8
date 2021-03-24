<template>
    <div>
        <h1>Pagina de registro:</h1>
        <form @submit.prevent="signUp">
            <!-- <input type="hidden" name="_token" v-bind:value="csrf"> -->

            <label for="name">Nombre:
            <br>
            <input type="text" id="name" name="name" v-model="form.name">
        </label>

        <br>
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
    name:'SignUp',
    data(){
        return {
            form : {
                name:"",
                email:"",
                password:""
            }
            //csrf token
            /* csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') */
        }
        },
        methods:{

            async signUp() {
                try {
                let res = await axios.post('/api/signUp',this.form)
                .then(response => {
                    console.log(response.data.message);
                    this.$router.push('/');
                })

            } catch (e) {
                 console.log(e.response) // undefined
            }
        }
            /* signUp(){
                axios.post('api/signUp',this.form)
                .then(response => {
                    console.log(response.data.message);

                })
                .catch(err => console.log(err.response))
            } */
        },    
    components:{
        
    }
})
</script>
