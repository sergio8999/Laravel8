<template>
    <div>
        <h1>Esto es el Home</h1>
        <p>{{prueba}}</p>
    </div>
</template>

<script>
import axios from 'axios'
export default ({
    name:'Home',
    data(){
            return {
                prueba:""
            }
        },
    mounted(){
            axios.get('api/prueba')
                .then(response => {
                    this.prueba = response.data
                })
        }
})
</script>
