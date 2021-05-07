<template>
    <div v-if="houses != null" class="d-flex flex-column justify-content-center align-items-center">
        <h1 class="text-center mt-3">Casas</h1>    
        <transition-group name="list" appear> 
            <div class="row m-0 mt-2 mb-2 p-3 houses d-flex justify-content-center align-items-center" v-for="house in houses" :key="house.id">
                <div class="col-3">
                    <img :src="`/storage/${house.url}`" :alt="house.name">
                </div>
                <div class="col-6">
                    <h3 class="text-center">{{house.name}}</h3>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <button class="btn"><i class="fas fa-edit lead btn-edit"></i></button>
                    <button class="btn"><i class="fas fa-trash-alt lead btn-delete"></i></button>
                </div>
            </div>
        </transition-group>
    </div>
    
    <div v-else class="d-flex justify-content-center align-items-start">
        <i class="pi pi-spin pi-spinner mt-4" style="fontSize: 2rem"></i>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import { getHouses } from '@/utils/api'

export default {
    name:'EditHouse',
    setup(){
        const houses = ref(null);

        onMounted(async()=>{
            try{
                let response = await getHouses();
                houses.value = response.data;
            }catch(e){
                console.log(e);
            }
        })

        return { houses }
    }
}
</script>

<style lang='scss'>
@import '../../scss/app.scss';

    .houses{
        box-shadow: 0 0 3px black;
        width: 100%;

        @media (min-width: 992px){
            width: 80%;
        }


        img{
            width: 100%;
            height: 5rem;
            border-radius: 10px 10px;
            object-fit: cover;
        }

        .btn-delete{
            color: $color-red;
        }

        .btn-edit{
            color: $color-blue;
        }
            
        svg{
            font-size: 1.5rem;
        }
    }   

    .list-enter-active{
        transition: all 3s;
    }

    .list-leave-active{
        transition: all 1s;
    }

    .list-enter-from, .list-leave-to{
        opacity: 0;
    }
</style>