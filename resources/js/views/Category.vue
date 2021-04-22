<template>
    <div v-if="houseFilter !=null">

        <div class="d-flex align-items-center mt-5 ml-5">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" @click="filterActivated = false">
                Filtar por 
            </button>
            <p class="ml-2 filter" v-if="province && filterActivated">Provincia <span id="provinceFilter" @click="deleteFilter">&times;</span></p>
            <p class="ml-2 filter" v-if="wifi && filterActivated">Wifi <span id="wifiFilter" @click="deleteFilter">&times;</span></p>
            <p class="ml-2 filter" v-if="pool && filterActivated">Piscina <span id="poolFilter" @click="deleteFilter">&times;</span></p>
        </div>
        <!-- Button trigger modal -->
        

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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"  @click="filterActivated = true">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="getHouseFilter">Buscar</button>
                    </div>
                </div>
            </div>
        </div>

         <h1 class="tittle">{{category}}</h1>
        
        <!-- Card -->
        <div class="row d-flex justify-content-center cards">
           <div class="col-10 col-lg-5 m-3" v-for="house in houseFilter" :key="house.id">
               <card-house :house="house" />
            </div>
       </div>

       <p class="text-center" v-if="houseFilter.length == 0">No hay Alojamientos</p>

    </div>
    <div v-else class="d-flex justify-content-center align-items-start mt-5">
        <i class="pi pi-spin pi-spinner" style="fontSize: 2rem"></i>
    </div>
</template>

<script>
import cardHouse from '../components/CardHouse.vue'
import { useStore } from 'vuex'
import route from "@/router"
import {computed, onMounted, ref } from 'vue'
import { getHouseCategory, getLocations } from '@/utils/api'

export default ({
    name:'Category',
    components:{
        cardHouse
    },
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
        const category = ref(route.currentRoute.value.query.name);
        const selectProvince = ref('Álava');
        const selectCategory = ref('Alojamientos enteros');
        const filterActivated = ref(false);
        const province = ref(false);
        const categoryValue = ref(false);
        const wifi = ref(false);
        const pool = ref(false);
        
        onMounted(async()=>{

            try{
                let response = await getHouseCategory(route.currentRoute.value.params.id);
                houses.value = response.data.houses;
                houseFilter.value = response.data.houses;
            }catch(e){
                console.log(e);
            }

            try{
                let response = await getLocations();
                locations.value = response.data.locations
            }catch(e){
                console.log(e);
            }

        })

        const getHouseFilter = ()=>{
            if(!province.value && !wifi.value && !pool.value && !categoryValue.value){
                houseFilter.value = houses.value;
                filterActivated.value = false;
            }else{
                filterActivated.value = true;
                houseFilter.value = houses.value.filter((house)=>{
                    if((province.value ? house.location.name == selectProvince.value:true) && (wifi.value ? house.details.wifi == "true": true) && (pool.value ? house.details.pool == "true": true) && (categoryValue.value ? house.category.name == selectCategory.value:true)){
                        return true;
                    }
                    
                    return false;
                });
            }
        }

        const deleteFilter = (e)=>{
            if(e.target.id == "provinceFilter"){
                province.value = false;
                getHouseFilter();
            }else if(e.target.id == "wifiFilter"){
                wifi.value = false;
                getHouseFilter();
            }else if(e.target.id == "poolFilter"){
                pool.value = false;
                getHouseFilter();
            }else if(e.target.id == "categoryFilter"){
                categoryValue.value = false;
                getHouseFilter();
            }
        }

        return { loggedIn ,selectProvince, houseFilter, locations, category,filterActivated, province, categoryValue, wifi, pool, getHouseFilter, deleteFilter};
    },

})
</script>
<style scoped lang = "scss">
@import '../../scss/app.scss';

    .cards{
        width: 100%;
    }

    input[type=checkbox]{
        width: 1rem;
        height: 1rem;
    }

    .tittle{
        text-align: center;
        font-family: $noto-serif;
    }

    .filter{
        background-color: $color-blue;
        color: $color-white;
        padding: .1rem 0.2rem;
        font-size: .7rem;
        border: $color-blue 1px solid;
        border-radius: 5px 5px;
        transition: all 0.5s ease;
        
        span{
            cursor: pointer;
        }

        &:hover{
            background-color: $color-white;
            color: $color-blue;
        }
    } 

</style>
