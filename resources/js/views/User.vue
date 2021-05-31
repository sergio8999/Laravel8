<template>
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
        </nav>

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
                <div class="col-3 col-lg-2">
                    <ul class="p-0">
                        <li @click="show" id="information" class="sidebar p-2">Información usuario</li>
                        <li @click="show" id="reservation" class="sidebar p-2">Reservas</li>
                    </ul>
                </div>
                <div class="col-9 col-lg-10">
                    <div v-if="value == 'information'">
                        <h1 class="mb-4">Perfil:</h1>
                        <p><b>Nombre:</b> {{user.name}}</p>
                        <p><b>Email:</b> {{user.email}}</p> 
                    </div>
                    <div v-if="value == 'reservation'">
                        <h1 class="mb-4 text-center text-lg-left">Reservas:</h1>

                        <!-- Card reservation -->
                        <div class="row d-flex justify-content-center ">
                            <transition-group name="list" appear>
                                <div class="col-10 col-lg-3 mt-3 mx-lg-3 card-reservation p-0" v-for="(reservation,index) in reservations" :key="reservation.id">
                                    <div>
                                        <img :src="`/storage/${reservation.house.url}`"  :alt="reservation.house.name">
                                    </div>
                                    <div class="my-2 d-flex justify-content-around">
                                        <div class="row card-reservation-description">
                                            <div class="col-12 mb-2 text-center card-reservation-description-name">
                                                <b>{{reservation.house.name}}</b>
                                            </div>
                                            <div class="col-6">
                                                <b>D.llegada:</b> {{reservation.arrivalDay}}
                                            </div>
                                            <div class="col-6">
                                            <b>D. salida:</b> {{reservation.departureDay}}
                                            </div>
                                            <div class="col-6">
                                                <b>H.llegada:</b> {{reservation.arrivalTime}}
                                            </div>
                                            <div class="col-6">
                                                <b>H. salida:</b> {{reservation.departureTime}}
                                            </div>
                                            <div class="col-6 mt-1">
                                                <b>Precio:</b> {{reservation.total}}€
                                            </div>
                                        </div>
                                        <div>
                                            <button v-if="checkDateDelete(reservation.arrivalDay,reservation.arrivalTime)" class="d-flex justify-content-center align-items-center btn-delete" v-tooltip="'Eliminar'" @click="getIdReservation(reservation.id,index)"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </transition-group>
                        </div>
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
    components:{
        
    },
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

        const checkDateDelete = (arrivalDay, arrivalTime)=>{
            let a  = moment(arrivalDay + " " + arrivalTime,'DD/MM/YYYY HH:mm').format('YYYY MM DD HH:mm'); 
            let b = moment().toDate();

            return moment(a,'YYYY/MM/DD HH:mm').isAfter(b,'hour');
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

        
        return { user, show, value, reservations, destroyReservation, disabledButton, getIdReservation, checkDateDelete };
    }, 
    methods:{

    },    
    components:{
        
    }
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';

    .card-reservation{

        box-shadow: 0 0 4px #343a40;
        border-radius: 10px 10px;
        transition: all .5s ease;

        &:hover{
            transform: scale(1.05);
            box-shadow: 1px 1px 6px #343a40;

        }

        img{
            width: 100%;
            height: 7rem;
            object-fit: cover;
            border-radius:10px 10px 0px 0px
        }

        &-description{
            width: 90%;
            font-size: 0.9rem;

            &-name{
                font-size: 1rem;
            }
        }
    }
    

    .sidebar{
        font-size: .9rem;
        list-style: none;
        cursor: pointer;

        &:hover{
            color: white;
            background-color: #343a40;
        }

        @media (min-width: 960px) {
            font-size: 1.2rem;
        }
    }

    .resume{
        width:50%;
    }

    .btn-delete{
        width: 2rem;
        height: 2rem;
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
