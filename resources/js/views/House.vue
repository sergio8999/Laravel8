<template>
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h1>{{house.name}}</h1>
        <img :src="`/images/${house.url}`" alt="">
        </div>
        <div class=" mt-4">
                <h3>Anfitrión: {{house.host}}</h3>
                <p>{{house.description}}</p>
        </div>   
        <Calendar v-model="value" :inline="true"  />
    </div>
</template>

<script>
import axios from 'axios'

export default ({
    name:'House',
    data(){
        return {
            house:[],
            value:null
        }
    },
    setup(){
        
    },
    mounted(){
        axios.get('/api/house/'+this.$route.params.id)
            .then(response => {
                this.house = response.data;
            }) 
        }
})
</script>
<style scoped>
    img{
        width: 100%;
        height: 30rem;
    }
</style>
