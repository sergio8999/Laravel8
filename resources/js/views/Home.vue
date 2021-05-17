<template>
    <div v-if="categories.length != 0">
        <div class="hero d-flex flex-column align-items-center">
            <img src="/storage/hero.jpg" alt="hero">
            <span class="p-2 text-center">Todo es posible gracias a los anfitriones</span>
        </div>
        <div class="categories">
            <h2 class="mt-5">Vive donde quieras</h2>
            <div class="row d-flex justify-content-center align-items-center my-5">
                <transition-group name="list" appear>
                    <div class="categories-category col-12 col-md-5 col-lg-3 mt-3 mt-md-4 mt-lg-0" v-for="category in categories" :key="category.id">
                        <router-link :to="{name:'category',params:{id:category.id},query:{name:category.name}}">
                            <img class="categories-img" :src="`/storage/${category.url}`" alt="">
                            <span class="categories-text">{{category.name}}</span>
                        </router-link>
                    </div>
                </transition-group>
            </div> 
        </div>
    </div> 
    <div v-else class="d-flex justify-content-center align-items-start mt-5">
        <i class="pi pi-spin pi-spinner" style="fontSize: 2rem"></i>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from "vue"
/* import * as api from '@/utils/api' */
import { getCategories } from '@/utils/api'
import { getLogin } from '@/utils/checkLogin'
import { useStore } from 'vuex'


export default({
    name:'Home',
    data(){
        return {
            
        }
    },
    setup() {
        const categories = ref([]);
        const store = useStore();

        onMounted(async()=>{
            /* axios.get('/api/categories')
            .then(response => {
                categories.value = response.data.categories;
            })
            .catch(error=>{
                console.log(error);
            }) */

           /*  getCategories()
            .then(response => {
                categories.value = response.data.categories;
            }) */
            
            getLogin();
                try{
                    let response = await getCategories();
                    categories.value = response.data.categories;
                    console.log(response.data.categories)
                    debugger
                }catch(e){
                    console.log(e);
                }            
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
        }
    }

    .categories{
        width: 80%;
        margin: auto;
        min-height: 30rem;;

        h2{
            text-align: center;

            @media (min-width: 960px) {
                text-align: left;
            }
        }

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
            display: block;
            text-align: center;

            @media (min-width: 960px) {
                display: inline-block;
            }
        }        
    }    

    .list-enter-active, .list-leave-active{
        transition: all 4s;
    }

    .list-enter-to,
    .list-leave-from{
        opacity: 1;
        transform: translateY(0);
    }

    .list-enter-from, .list-leave-to{
        opacity: 0;
        transform: translateY(60px);
    }

</style>