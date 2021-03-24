<template>
    <div>
        <h1>Pagina de registro:</h1>
        <button @click="user">User</button>
        <button @click="logout">Cerrar Sesion</button>
    </div>
</template>

<script>
import axios from 'axios'
export default ({
    name:'User',
    data(){
        return {
            //csrf token
            /* csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') */
        }
        },
        methods:{

            async user() {
                try {
                let res = await axios.get('/api/user')
                .then(response => {
                    console.log(response.data);
                })

            } catch (e) {
                 console.log(e.response) // undefined
            }
        },
        async logout() {
                try {
                let res = await axios.get('/api/logout')
                .then(response => {
                    console.log(response.data);
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
