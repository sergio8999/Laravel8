<template>
    <div class="dashboard">
        <!--barra navegación-->
        <nav id="sideNav" class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark"> 
            <h4 class="d-lg-none text-light">Dashboard</h4>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
             <div class="collapse navbar-collapse d-lg-flex flex-column" id="navbarNavAltMarkup">
                <h4 class="d-lg-block d-none text-light">Dashboard</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-lg-flex justify-content-center align-items-center" href="#"><i class="fas fa-plus mr-2 lead"></i> Nueva casa</a>
                    </li>  
                    <li class="nav-item">
                      <a class="nav-link d-lg-flex justify-content-center align-items-center" href="#"><i class="fas fa-edit mr-2 lead"></i> Editar casa</a>
                    </li>  
                    <li class="nav-item">
                      <a class="nav-link d-lg-flex justify-content-center align-items-center" href="#">Nueva casa</a>
                    </li> 
                </ul>
            </div>
        </nav>
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sergio
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <router-link class="dropdown-item" to="/administrador" @click="logoutAdministrador"> Cerrar sesión</router-link>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>   

            <div class="container">
                <h2 class="text-center mb-4">Nueva casa</h2>
                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Nombre:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1" v-model="name">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Host:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Huésped" aria-label="Username" aria-describedby="basic-addon1" v-model="host">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Price:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Precio" aria-label="Username" aria-describedby="basic-addon1" v-model="price">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Imagen:</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" @change="getImage">
                                <label class="custom-file-label" for="inputGroupFile01">{{ image == null ? "Elige archivo" : image.name}}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Descripción: </span>
                            </div>
                            <textarea class="form-control" aria-label="With textarea" placeholder="Descripcion" v-model="description"></textarea>
                        </div>
                    </div>
                </div>      

                <div class="row mt-3">
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Provincia</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" v-model="selectProvince">
                                <option v-for="location in locations" :key="location.id">{{location.name}}</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect02">Categoria</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect02" v-model="selectCategory">
                                <option v-for="category in categories" :key="category.id">{{category.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>     

                <div>
                    <h4>Servicios: </h4>   
                    <div class="d-flex flex-column">
                        <label for="wifi" class="mt-1">
                            <input id="wifi" type="checkbox" class="mr-2" v-model="wifi" >Wifi
                        </label>
                        <label for="pool" class="mt-1">
                            <input id="pool" type="checkbox" class="mr-2" v-model="pool">Piscina
                        </label>
                    </div>
                </div> 
                
                <div class="row mt-3">
                    <div class="col-12 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect03">Huespedes</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect03" v-model="selectGuest">
                                <option v-for="number in numbers" :key="number" :value="number">{{number}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect04">Dormitorios</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect04" v-model="selectBedrooms">
                                <option v-for="number in numbers" :key="number" :value="number">{{number}}</option>
                            </select>
                        </div>
                    </div>
                     <div class="col-12 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect015">Camas</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect05" v-model="selectBeds">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                     <div class="col-12 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect06">Baños</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect06" v-model="selectToilets">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>   

                <h4>Carousel:</h4>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon02">Imagenes:</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon02" @change="getImagesCarousel" multiple>
                        <label class="custom-file-label" for="inputGroupFile02"></label>
                    </div>
                </div>

                <button class="btn bg-dark text-light mt-4" @click="setStoreHouse" :disabled="disabledButton">Añadir casa</button>
            </div>
        </div>
    </div>  
</template>

<script>
import { ref, onMounted, computed } from 'vue'
import { useStore } from 'vuex'
import axios from 'axios'

import { getCategories, setHouse, setCarousel, getLocations } from '@/utils/api'


export default ({
    name:'Dashboard',
    setup() {
        const store = useStore();
        const image = ref(null);
        const carousel = ref(null);
        const name = ref('');
        const locations = ref([]);
        const selectProvince = ref('Álava');
        const categories = ref([]);
        const selectCategory = ref('Alojamientos enteros');
        const selectGuest = ref(1);
        const selectBedrooms = ref(1);
        const selectBeds = ref(1);
        const selectToilets = ref(1);
        const host = ref('');
        const price = ref('');
        const wifi = ref(false);
        const pool = ref(false);
        const description = ref('');
        const numbers = ref([1,2,3,4,5,6,7,8,9]);
        const disabledButton = ref(false);


        onMounted(async()=>{
            if(sessionStorage)
                if(sessionStorage.getItem('administrador') != undefined)
                    store.state.administrador = true;
            try{
                let response = await getCategories();
                categories.value = response.data.categories;
                let response2 = await getLocations();
                locations.value = response2.data.locations;    
            }catch(e){
                console.log(e);
            }            
        })

        const logoutAdministrador = ()=>{
            store.state.administrador = false
            sessionStorage.removeItem('administrador');
        }

        const getImage = (e)=>{
            image.value = e.target.files[0];
        }

        const getImagesCarousel = (e)=>{
            carousel.value = e.target.files;
        }

        const setStoreHouse = async ()=>{
            disabledButton.value = true;
            try{
                const data = new FormData();
                data.append('name', name.value);
                data.append('host', host.value);
                data.append('price', price.value);
                data.append('description', description.value);
                data.append('guest',selectGuest.value);
                data.append('bedrooms',selectBedrooms.value);
                data.append('beds',selectBeds.value);
                data.append('toilets',selectToilets.value);
                data.append('pool',pool.value);
                data.append('wifi',wifi.value);
                data.append('image', image.value);
                data.append('carousel',carousel.value);
                data.append('category_id',getId('category', selectCategory.value));
                data.append('location_id',getId('province', selectProvince.value));
                await setHouse(data); 
                setStoreCarousel();
                disabledButton.value = false;
            }catch(e){
                console.log(e);
                disabledButton.value = false;
            }  
        }

        const setStoreCarousel = async ()=>{
            disabledButton.value = true;
            const data = new FormData();
            try{
                if(carousel.value.length !=0){
                    for(let i=0;i<carousel.value.length;i++){
                        data.append('image'+i,carousel.value[0]);
                    }
                    await setCarousel(data); 
                    resetInput();
                }
            }catch(e){
                console.log(e);
            }
            disabledButton.value = false;
        }

        const resetInput = ()=>{
            image.value = null;
            carousel.value = null;
            name.value = '';
            selectProvince.value = 'Álava';
            selectCategory.value = 'Alojamientos enteros';
            selectGuest.value = 1;
            selectBedrooms.value = 1;
            selectBeds.value = 1;
            selectToilets.value = 1;
            host.value = '';
            price.value = '';
            wifi.value = false;
            pool.value = false;
            description.value = '';
        }   

        /* Obtener id de categorias y provincias */
        const getId = (params, data)=>{
            let id;
            if(params == 'category'){
                id = categories.value.filter(category=>{
                    return category.name == data;
                })
            return id[0].id;
            }else if(params == 'province'){
                id = locations.value.filter(location=>{
                    return location.name == data;
                })
                return id[0].id;
            }
        }

		return { disabledButton, logoutAdministrador, getImage , getImagesCarousel, carousel, setStoreHouse, image, name, selectProvince, locations, categories, selectCategory, selectGuest, selectBedrooms, selectBeds, selectToilets, host, wifi, pool, price, description, numbers }
    },
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';

    .dashboard{
        font-family: inherit;
        font-size: inherit;
        color: inherit;
        background-color: inherit;
        overflow-x: hidden;
        overflow-y: scroll;
        position:relative;   

        svg{
            width: 1.2rem;
        }

        #sideNav {

            @media (min-width: 992px) {
        
                text-align: center;
                position: fixed;
                display: flex;
                flex-direction: column;
                width: 15rem;
                height: 100vh;   
                
                .navbar-collapse{
                display: flex;
                align-items: flex-start;
                flex-grow: 0;
                width: 100%;
                margin-bottom: auto;
                margin-top: 12vh;

                .navbar-nav{
                    flex-direction: column;
                    width: 100%;
                    display: block;

                    .nav-link{
                        display: block;
                    }
                }
            }
            }
    }

    .content{
        width: 100%;
        min-height: 100vh;
        margin-top: 5rem;
        @media (min-width: 992px){
            width: auto;
            margin-left: 15rem;
        }
        
    }     

}



</style>