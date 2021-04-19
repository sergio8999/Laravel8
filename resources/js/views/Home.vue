<template>
    <div class="hero d-flex flex-column align-items-center">
        <img src="/images/hero.jpg" alt="hero">
        <span>Todo es posible gracias a los anfitriones</span>
    </div>
    <div class="categories">
        <h2 class="mt-5">Vive donde quieras</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
                <div class="categories-category col-12 col-md-5 col-lg-3 mt-3 mt-md-4 mt-lg-0" v-for="category in categories" :key="category.id">
                    <router-link :to="{name:'category',params:{id:category.id}}">
                        <img class="categories-img" :src="`/images/${category.url}`" alt="">
                        <span class="categories-text">{{category.name}}</span>
                    </router-link>
                </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from "vue"
import {categories} from '@/utils/api'


export default({
    name:'Home',
    data(){
        return {
            
        }
    },
    setup() {
        const categories = ref([]);

        onMounted(()=>{
            axios.get('/api/categories')
            .then(response => {
                categories.value = response.data.categories;
            })
            .catch(error=>{
                console.log(error);
            })
        })

        return {categories};
    },
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';
.hero{
    width: 100%;
    height: 80vh;
    background-color: $color-primary;

    img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    span{
        color: $color-white;
        font-size: 2.5rem;
        padding: 2rem;
    }
}

    .categories{
        width: 80%;
        margin: auto;

        &-img{
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        a{
            text-decoration: none;
        }
        
        &-text{
            color: black;
            font-size: 1.2rem;
            font-weight: bold;
        }        

    }    
</style>