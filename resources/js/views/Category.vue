<template>
   <div v-if="categories.length !=0">
        <h1 class="text-center">{{categories.name}}</h1>
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
    <div v-else class="d-flex justify-content-center align-items-start mt-5">
        <i class="pi pi-spin pi-spinner" style="fontSize: 2rem"></i>
    </div>
</template>
<script>
import axios from 'axios'
import {  onMounted, ref } from "vue"
import route from "@/router"
import router from "@/router"

export default ({
    name:'Category',
    data(){
        return {
                
        }
    },
    setup() {
        const categories = ref([]);
        const houses = ref([]);

        onMounted(() => {
             axios.get('/api/categories/'+ route.currentRoute.value.params.id)
            .then(response => {
                if(response.data.categories == 404)
                    router.push({path:'/error404',query:{id:'2',name:'categoria'}});
                else{
                    categories.value = response.data.categories;
                    houses.value = response.data.categories.houses;
                }
            })
        })

        return {categories, houses};
    }
})
</script>

<style scoped lang="scss">

</style>