<template>
    <div v-if="houses.length !=0">
        <h1 class="text-center">Alojamientos</h1>
        <div class="d-flex flex-wrap flex-row justify-content-center">
            <div v-for="house in houses" :key="house.id" class="card m-2" style="width: 18rem;">
                <img :src="`/images/${house.url}`" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{house.name}}</h5>
                    <p class="card-text">{{house.description}}</p>
                    <p class="card-text">{{house.price}}€/h</p>
                    <div class="d-flex justify-content-center">
                        <router-link :to="{name:'house',params:{id:house.id}}" class="btn btn-dark">Ver casa</router-link>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div v-else class="d-flex justify-content-center mt-5">
        <i class="pi pi-spin pi-spinner" style="fontSize: 2rem"></i>
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
            houses:[]
        }
    },
    setup(){
        const store = useStore();
        const loggedIn = computed(()=> store.state.loggedIn);
        return {loggedIn};
    },
    mounted(){
        axios.get('/api/houses')
            .then(response => {
                this.houses = response.data
            }) 
        }
})
</script>
<style scoped>

</style>
