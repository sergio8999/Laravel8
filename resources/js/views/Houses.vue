<template>
    <div v-if="houseFilter !=null">

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
                        <span>Provincia:</span>
                        <div class="d-flex justify-content-center align-items-center">   
                            <input type="checkbox" v-model="province">
                            <select class="custom-select mt-1 ml-2" id="inputGroupSelect03" aria-label="Example select with button addon"  v-model="selectProvince" :disabled="!province">
                                <option v-for="location in locations" :key="location.value" >{{location.name}}</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-start mt-3">
                            <span>Servicios: </span>   
                            <label for="wifi" class="mt-1">
                                <input id="wifi" type="checkbox" class="mr-2" v-model="wifi" >Wifi
                            </label>
                            <label for="pool" class="mt-1">
                                <input id="pool" type="checkbox" class="mr-2" v-model="pool">Piscina
                            </label>
                        </div>
                        <span>Categoria:</span>
                        <div class="d-flex justify-content-center align-items-center">   
                            <input type="checkbox" v-model="categoryValue">
                            <select class="custom-select mt-1 ml-2" id="inputGroupSelect03" aria-label="Example select with button addon"  v-model="selectCategory " :disabled="!categoryValue">
                                <option v-for="category in categories" :key="category.value" >{{category.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="getHouseFilter">Buscar</button>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-center">Alojamientos</h1>
        <div class="d-flex flex-wrap justify-content-center">
            <div v-for="house in houseFilter" :key="house.id" class="card m-2" style="width: 18rem;">
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
            <p v-if="houseFilter.length == 0">No hay Alojamientos</p>
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
import { getHouses, getLocations, getCategories } from '@/utils/api'

export default ({
    name:'Houses',
    data(){
        return {
           
        }
    },
    setup(){
        const store = useStore();
        const loggedIn = computed(()=> store.state.loggedIn);
        const houseFilter = ref();
        const houses = ref(null);
        const locations = ref([]);
        const categories = ref([]);
        const selectProvince = ref('Álava');
        const selectCategory = ref('Alojamientos enteros');
        const province = ref(false);
        const categoryValue = ref(false);
        const wifi = ref(false);
        const pool = ref(false);
        
        onMounted(async()=>{

            try{
                let response = await getHouses();
                houses.value = response.data;
                houseFilter.value = response.data;
            }catch(e){
                console.log(e);
            }

            try{
                let response = await getLocations();
                locations.value = response.data.locations
            }catch(e){
                console.log(e);
            }

            try{
                let response = await getCategories();
                categories.value = response.data.categories;
            }catch(e){
                console.log(e);
            }
        })

        const getHouseFilter = ()=>{
            if(!province.value && !wifi.value && !pool.value && !categoryValue.value){
                houseFilter.value = houses.value;
            }else{
                houseFilter.value = houses.value.filter((house)=>{
                    if((province.value ? house.location.name == selectProvince.value:true) && (wifi.value ? house.details.wifi == "true": true) && (pool.value ? house.details.pool == "true": true) && (categoryValue.value ? house.category.name == selectCategory.value:true)){
                        return true;
                    }
                    
                    return false;
                });
            }
            
        }

        return { loggedIn ,selectProvince, selectCategory, houseFilter, locations, categories, province, categoryValue, wifi, pool, getHouseFilter};
    },

})
</script>
<style scoped>

    .divImagen{
        width: 100%;
    }

    input[type=checkbox]{
        width: 1rem;
        height: 1rem;
    }

</style>
