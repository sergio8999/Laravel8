<template>
    <div v-if="houses.length !=0">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark mt-5 ml-5 " data-toggle="modal" data-target="#exampleModal">
        Filtar por 
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filtar por: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Provincia</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" v-model="selectProvince">
                        <option v-for="location in locations" :key="location.value">{{location.name}}</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Aplicar</button>
            </div>
            </div>
        </div>
        </div>

        <h1 class="text-center">Alojamientos</h1>
        <div class="d-flex flex-wrap justify-content-center">
            <div v-for="house in houses" :key="house.id" class="card m-2" style="width: 18rem;">
                <div class="divImagen">
                    <img :src="`/images/${house.url}`" class="card-img-top" alt="...">
                </div>
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
    <div v-else class="d-flex justify-content-center align-items-start mt-5">
        <i class="pi pi-spin pi-spinner" style="fontSize: 2rem"></i>
    </div>
    
</template>

<script>
import axios from 'axios'
import { useStore } from 'vuex'
import {computed, onMounted, ref} from 'vue'

export default ({
    name:'Houses',
    data(){
        return {
           
        }
    },
    setup(){
        const store = useStore();
        const loggedIn = computed(()=> store.state.loggedIn);

        const houses = ref([]);
        const locations = ref([]);
        const selectProvince = ref('Álava');
        
        onMounted(()=>{
            axios.get('/api/houses')
            .then(response => {
                houses.value = response.data
            }) 

            axios.get('/api/locations')
            .then(response => {
                locations.value = response.data.locations
            }) 
        })

        const setFilter = ()=>{
            axios.get('/api/')
            .then(response => {
                houses.value = response.data
            }) 

        }

        return {loggedIn, houses, locations, selectProvince};
    },

})
</script>
<style scoped>
    .divImagen{
        width: 100%;
    }
</style>
