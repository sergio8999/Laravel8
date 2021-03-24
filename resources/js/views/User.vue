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
                    let res = await axios.get('/api/user',{headers: {Authorization: 'Bearer ' + this.information.access_token}});
                    console.log(res.data);

                } catch (e) {
                    console.log(e.response) 
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
                    console.log(e.response) 
                }
            }
        },    
    components:{
        
    }
})
</script>
