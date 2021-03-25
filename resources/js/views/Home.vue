<template>
    <div>
        <h1>Esto es el Home</h1>
        <p>{{prueba}}</p>
    </div>
</template>

<script>
import axios from 'axios'
import { useStore } from 'vuex'
import {computed} from 'vue'

export default ({
    name:'Home',
    data(){
        return {
            prueba:""
        }
    },
    setup(){
        const store = useStore();
        const loggedIn = computed(()=> store.state.loggedIn);
        return {loggedIn};
    },
    mounted(){
            axios.get('api/prueba')
                .then(response => {
                    this.prueba = response.data
                })
        }
})
</script>
<style scoped>

</style>
