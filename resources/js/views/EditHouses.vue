<template>
    <div v-if="houses != null" class="d-flex flex-column justify-content-center align-items-center">
        <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Casa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Esta seguro de que desea eliminar la casa?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="destroyHouse" data-dismiss="modal" >Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

        <h1 class="text-center mt-3">Casas</h1>    
        <transition-group name="list" appear> 
            <div class="row m-0 mt-2 mb-2 p-3 houses d-flex justify-content-center align-items-center" v-for="(house,index) in houses" :key="house.id">
                <div class="col-3">
                    <img :src="`/storage/${house.url}`" :alt="house.name">
                </div>
                <div class="col-6">
                    <h3 class="text-center">{{house.name}}</h3>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <router-link class="btn" :to="{name:'editHouse',params:{id:house.id}}" tag="button"><i class="fas fa-edit lead btn-edit"></i></router-link>
                    <button class="btn" v-tooltip="'Eliminar'" @click="getIdHouse(house.id,index)" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt lead btn-delete"></i></button>
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
import { getHouses, deleteHouse } from '@/utils/api'
import { useToast } from "primevue/usetoast"

export default {
    name:'EditHouses',
    setup(){
        const toast = useToast();
        const houses = ref(null);
        const idHouse = ref();
        const indexHouse = ref();

        onMounted(async()=>{
            try{
                let response = await getHouses();
                houses.value = response.data;
            }catch(e){
                console.log(e);
            }
        })

        const getIdHouse = (house,index)=>{
            idHouse.value = house;
            indexHouse.value  = index;
        }

        const destroyHouse = async()=>{
            try{
                let response = await deleteHouse(idHouse.value);
                houses.value.splice(indexHouse.value,1);
                toast.add({severity:'success', summary: 'Success Message', detail:'Casa borrada correctamente', life: 3000});
            }catch(e){
                console.log(e);
                toast.add({severity:'error', summary: 'Error Message', detail:'Error al borrar la casa', life: 3000});
            }
        }

        return { houses, destroyHouse, getIdHouse }
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