<template>
    <div class="container-fluid my-3">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reserva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Esta seguro de que desea eliminar la reserva?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="destroyReservation" data-dismiss="modal" >Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <ul>
                    <li @click="show" id="information" class="sidebar p-2">Información usuario</li>
                    <li @click="show" id="reservation" class="sidebar p-2">Reservas</li>
                </ul>
            </div>
            <div class="col-6 d-flex flex-column justify-content-center">
                <div v-if="value == 'information'">
                    <h1 class="mb-4">Perfil:</h1>
                    <p><b>Nombre:</b> {{user.name}}</p>
                    <p><b>Email:</b> {{user.email}}</p>           
                </div>
                <div v-if="value == 'reservation'">
                    <h1 class="mb-4">Reservas:</h1>
                    <div class="accordion" id="accordionExample">
                        <transition-group name="list" appear>
                            <div class="card mb-2" v-for="(reservation,index) in reservations" :key="reservation.id">
                                <div class="card-header" :id="`heading${reservation.id}`">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" :data-target="`#Collapse${reservation.id}`" aria-expanded="false" :aria-controls="reservation.id">
                                            <p>Casa: {{reservation.house.name}}</p>
                                    </button>
                                </h2>
                                </div>
                                <div :id="`Collapse${reservation.id}`" class="collapse show" :aria-labelledby="`heading${reservation.id}`" data-parent="#accordionExample">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <p><b>Dia llegada: </b>{{reservation.arrivalDay}}</p>
                                            <p><b>Dia salida: </b>{{reservation.departureDay}}</p>
                                            <p><b>Hora salida: </b>{{reservation.arrivalTime}}</p>
                                            <p><b>Dia salida: </b>{{reservation.departureTime}}</p>
                                        </div>
                                        <button class="d-flex justify-content-center align-items-center btn-delete" v-tooltip="'Eliminar'" @click="getIdReservation(reservation.id,index)"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </transition-group>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
import { onMounted, computed, ref } from 'vue';
import { useStore } from 'vuex'
import { getReservationUser, deleteReservation } from '@/utils/api'
import { getLogin } from '@/utils/checkLogin'
import { useToast } from "primevue/usetoast"
import moment from 'moment'

export default ({
    name:'User',
    data(){
        return {
            
        }
    },
    setup(){
        const store = useStore(); 
        const toast = useToast();
        const value = ref('information');
        const user = computed(()=> store.state.informationUser);
        const reservations = ref([]);
        const disabledButton = ref(false);
        const idReservation = ref();
        const indexReservation = ref();

         onMounted(async()=>{
            /* const { user } = useUser();
            user = user; */

            getLogin();

            try{
                let response = await getReservationUser(user.value.id);
                reservations.value = response.data.reservation;
            }catch(e){
                console.log(e);
            }
        }); 

        const show = (e)=>{
            if(e.target.id == 'information'){
                value.value = 'information';
            }else if(e.target.id == 'reservation'){
                value.value = 'reservation';  
            }          
        }

        const getIdReservation = (reservation,index)=>{
            idReservation.value = reservation;
            indexReservation.value  = index;
        }

        const destroyReservation = async()=>{
            disabledButton.value = true;
            try{
                let response = await deleteReservation(idReservation.value);
                reservations.value.splice(indexReservation.value,1);
                toast.add({severity:'success', summary: 'Success Message', detail:'Reserva borrada correctamente', life: 3000});
                disabledButton.value = false;
            }catch(e){
                console.log(e);
                toast.add({severity:'error', summary: 'Error Message', detail:'Error al borrar la reserva', life: 3000});
                disabledButton.value = false;
            }          
        }

        
        return { user, show, value, reservations, destroyReservation, disabledButton, getIdReservation };
    }, 
    methods:{

    },    
    components:{
        
    }
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';

    .sidebar{
        font-size: 1.3rem;
        list-style: none;
        cursor: pointer;
    }
    .sidebar:hover{
        color: white;
        background-color: #343a40;
    }

    .btn-delete{
        width: 3rem;
        height: 3rem;
        background-color: $color-red;
        border: 1px solid $color-red;
        transition: all 0.5s ease;

        &:hover{
            background-color : $color-white;
        }

        &:hover svg{
            color: $color-red;
        }

        svg{
            color:$color-white;

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
