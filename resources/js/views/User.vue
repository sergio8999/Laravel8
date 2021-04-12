<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-2">
                <ul>
                    <li @click="show" id="information" class="sidebar p-2">Información usuario</li>
                    <li @click="show" id="reservation" class="sidebar p-2">Reservas</li>
                </ul>
            </div>
            <div class="col-6 d-flex flex-column justify-content-center">
                <div v-if="value == 'information'">
                    <h1 class="mb-4">Perfil:</h1>
                    <p><b>Nombre:</b>{{user.name}}</p>
                    <p><b>Email:</b>{{user.email}}</p>           
                </div>
                <div v-if="value == 'reservation'">
                    <h1 class="mb-4">Reservas:</h1>
                    <div class="accordion" id="accordionExample">
                        <div class="card" v-for="reservation in reservations" :key="reservation.id">
                            <div class="card-header" :id="`heading${reservation.id}`">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" :data-target="`#Collapse${reservation.id}`" aria-expanded="false" :aria-controls="reservation.id">
                                    <p>Id Reserva: {{reservation.id}}</p>
                                    <p>Casa: {{reservation.house.name}}</p>
                                   
                                </button>
                            </h2>
                            </div>
                            <div :id="`Collapse${reservation.id}`" class="collapse show" :aria-labelledby="`heading${reservation.id}`" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p><b>Dia llegada: </b>{{reservation.arrivalDay}}</p>
                                    <p><b>Dia salida: </b>{{reservation.departureDay}}</p>
                                    <p><b>Hora salida: </b>{{reservation.arrivalTime}}</p>
                                    <p><b>Dia salida: </b>{{reservation.departureTime}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
import { onMounted, computed, ref } from 'vue';
import axios from 'axios'
import { useStore } from 'vuex'
import useUser from '@/composables/useUser'

export default ({
    name:'User',
    data(){
        return {
            
        }
    },
    setup(){
        const store = useStore(); 
        /* const { user } = useUser(); */
        const value = ref('information');
        const user = computed(()=> store.state.informationUser);
        const reservations = ref([]);

         onMounted(()=>{
            /* const { user } = useUser();
            user = user; */
            axios.post('/api/reservation/show',{'user_id': user.value.id})
                .then(response => {
                    console.log(response.data.reservation);
                    reservations.value = response.data.reservation;
                }) 
                .catch(error => {
                    console.log(error)
                });
        }); 

        const show = (e)=>{
            if(e.target.id == 'information'){
                value.value = 'information';
            }else if(e.target.id == 'reservation'){
                value.value = 'reservation';  
            }          
        }
        
        return { user, show, value, reservations };
    }, 
    methods:{

    },    
    components:{
        
    }
})
</script>

<style scoped>
    .sidebar{
        font-size: 1.3rem;
        list-style: none;
        cursor: pointer;
    }
    .sidebar:hover{
        color: white;
        background-color: #343a40;
    }
</style>
