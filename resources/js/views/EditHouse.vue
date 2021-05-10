<template>
    <div v-if="house !=null && categories !=null && locations !=null ">
        <h2 class="text-center pt-3 mb-4">Nueva casa</h2>
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

            <div class="col-12 col-lg-6 d-flex">
                <div class="input-group mb-3 d-flex align-items-center">
                <input class="mr-2" type="checkbox" v-model="imageValue">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Imagen:</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" :disabled=!imageValue @change="getImage">
                        <label class="custom-file-label" for="inputGroupFile01">{{getNameImage}}</label>
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
                        <option v-for="number in numbers" :key="number" :value="number">{{number}}</option>
                    </select>
                </div>
            </div>
                <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect06">Baños</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect06" v-model="selectToilets">
                        <option v-for="number in numbers" :key="number" :value="number">{{number}}</option>
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
                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon02"  multiple>
                <label class="custom-file-label" for="inputGroupFile02">{{nameCarousel}}</label>
            </div>
        </div>

        <button class="btn bg-dark text-light mt-4" :disabled="disabledButton" @click="edit">Actualizar</button>
    </div>
    <div v-else class="d-flex justify-content-center align-items-start">
        <i class="pi pi-spin pi-spinner mt-4" style="fontSize: 2rem"></i>
    </div>
</template>

<script>
import { computed, onMounted, ref } from 'vue'
import { useToast } from "primevue/usetoast"
import { getHouse, getLocations, getCategories, editHouse } from '@/utils/api'
import router from "@/router"
import route from "@/router"

export default {
    name:'editHouse',
    setup(){
        const toast = useToast();
        const house = ref(null);
        const imageValue = ref(false);
        const image = ref(null);
        const selectProvince = ref(null);
        const selectCategory = ref(null);
        const name = ref("");
        const host = ref("");
        const price = ref("");
        const description = ref("");
        const pool = ref(false);
        const wifi = ref(false);
        const selectGuest = ref(null);
        const selectBedrooms = ref(null);
        const selectBeds = ref(null);
        const selectToilets = ref(null);        
        const locations = ref(null);
        const categories = ref(null);
        const numbers = ref([1,2,3,4,5,6,7,8,9]);
        const nameCarousel = ref("");
        const disabledButton = ref(false);


        onMounted(async ()=>{
            try{
                let response = await getHouse(route.currentRoute.value.params.id)
                if(response.data.house ==  404)
                    router.push({path:'/404',query:{id:route.currentRoute.value.params.id,name:'casa'}});
                else{
                    house.value = response.data.house;
                    
                    let response2 = await getLocations();
                    locations.value = response2.data.locations;
                    let response3 = await getCategories();
                    categories.value = response3.data.categories;
                    name.value = house.value.name;
                    host.value = house.value.host;
                    price.value = house.value.price;
                    description.value = house.value.description;
                    selectProvince.value = house.value.location.name;
                    selectCategory.value = house.value.category.name;
                    pool.value = house.value.details.pool;
                    wifi.value = house.value.details.wifi;
                    selectGuest.value = house.value.details.guests;
                    selectBedrooms.value = house.value.details.bedrooms;
                    selectBeds.value = house.value.details.beds;
                    selectToilets.value = house.value.details.toilets;
                    imageValue.value = false;
                    nameCarousel.value = getNameCarousel();
                }
            }catch(e){
                console.log(e);
            }
        })

        const getImage = (e)=>{
            image.value = e.target.files[0];
        }

        const getNameCarousel = ()=>{
            if(house.value.images == null)
                return "Elige archivo";
            else{
                let name = "";
                for(let image of house.value.images)
                    name += (image.url + " ");
                return name;
            }
        }

        const getNameImage = computed(()=>{
            let name="";
            if(imageValue.value){
                if(image.value == null)
                    name = "Elige imagen";
                else
                    name = image.value.name;
            }else
                name = house.value.url;

            return name;
        })

        const edit = async ()=>{
            disabledButton.value = true;
            try{
                const data = new FormData();
                data.append('id', house.value.id);
                data.append('name', name.value);
                data.append('host', host.value);
                data.append('price', price.value);
                data.append('description', description.value);
                data.append('pool', pool.value);
                data.append('wifi', wifi.value);
                data.append('guest', selectGuest.value);
                data.append('bedrooms', selectBedrooms.value);
                data.append('beds', selectBeds.value);
                data.append('toilets', selectToilets.value);
                data.append('category_id', getId('category', selectCategory.value));
                data.append('location_id', getId('category', selectCategory.value));
                if(imageValue.value){
                    data.append('image',image.value);
                }
                await editHouse(data);
                toast.add({severity:'success', summary: 'Success', detail:'Se ha editado correctamente.', life: 3000}); 
                disabledButton.value = false;
            }catch(e){
                console.log(e);
                toast.add({severity:'error', summary: 'Error', detail:'Debe rellenar todos los campos.', life: 3000}); 
                disabledButton.value = false;
            }
        }

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

        return { house, imageValue, getImage, getNameImage, selectProvince, selectCategory, locations, categories, numbers, name, host, price, description, pool, wifi, selectGuest, selectBedrooms, selectBeds, selectToilets, nameCarousel, disabledButton, edit };
    }
}
</script>

<style>

</style>