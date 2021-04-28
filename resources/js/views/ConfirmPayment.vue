<template>
    <div>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li class="breadcrumb-item"><router-link to="/houses">Houses</router-link></li>
                <li class="breadcrumb-item"><router-link :to="'/house/'+ reservationData.idHouse">House {{reservationData.idHouse}}</router-link></li>
                <li class="breadcrumb-item active" aria-current="page">Confirmar reserva </li>
            </ol>
        </nav>
        <div class="container">
            <h1 class="mt-3">Confirmar y pagar</h1>

            <div class="row">
            <div class="col-12 col-md-7 d-flex flex-column order-1 order-md-0">
                <h4 class="mt-4 mb-2">Fechas</h4>
                <span>Llegada: {{reservationData.arrivalDay}} {{reservationData.departureTime}}</span>
                <span>Salida: {{reservationData.departureDay}} {{reservationData.departureTime}}</span>    
                    
                <h4 class="mt-4 mb-2">Pagar con</h4>

                <div class="input-group mb-3 s-flex flex-column">
                    <select class="custom-select" id="inputGroupSelect01">
                        <option value="1">Tarjeta de crédito o débito</option>
                        <option value="2">Paypal</option>
                        <option value="3">Google Pay</option>
                    </select>

                    <input type="text" class="form-control mt-2" placeholder="Número de tarjeta" aria-label="Username" aria-describedby="basic-addon1">
                    <div class="d-flex flex-row">
                        <input type="text" class="form-control caducidad" placeholder="Caducidad" aria-label="Caducidad" aria-describedby="basic-addon1">
                        <input type="text" class="form-control cvv" placeholder="CVV" aria-label="CVV" aria-describedby="basic-addon1">
                    </div>
                    <input type="text" class="form-control mt-2" placeholder="Código Postal" aria-label="CodigoPostal" aria-describedby="basic-addon1">
                    <select class="custom-select mt-2" id="inputGroupSelect02">
                        <option selected>País/región</option>
                        <option value="1">España</option>
                        <option value="2">Estados Unidos</option>
                        <option value="3">Francia</option>
                    </select>

                    <h4 class="my-4">Politica de cancelación</h4>
                    <p>Cancela antes del {{getDayCancelation}} a las {{reservationData.arrivalTime}} PM y consigue un reembolso del 50%, menos la primera noche y la tarifa de servicio. Más información</p>
                    <p class="mt-2">Asegúrate de que la política de cancelación de este anfitrión te venga bien. Es posible que nuestra Política de Causas de Fuerza Mayor no cubra las interrupciones del viaje causadas por eventos conocidos, como la COVID-19, o por eventos previsibles, como condiciones meteorológicas adversas habituales.</p>
                    <button type="button" class="btn btn-dark" @click="setReservation" :disabled="disabledButton">Confirmar y pagar</button>
                </div>
            </div>

            <div class="col-12 col-md-5 d-flex flex-column align-items-center p-3 resume order-0 order-md-1">
                <div class="row">
                    <div class="col-4">
                        <img :src="`/images/${reservationData.image}`" :alt="reservationData.image">
                    </div>
                    <div class="col-8">
                        <h5>{{reservationData.name}}</h5>
                        <div class="d-flex">
                            <span class="ml-2">{{reservationData.beds}} cama/s</span> 
                            <span class="ml-2">·</span>
                            <span class="ml-2">{{reservationData.toilets}} baño/s</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row price">
                    <div class="col-12">
                        <h4>Detalles del precio:</h4>
                        <p>Subtotal ({{reservationData.price}}/h): {{reservationData.subtotal}}€</p>
                        <p>Impuestos: {{reservationData.taxes}}€</p>
                        <p><b>Total: </b>{{reservationData.totalPrices}}€</p>                    
                    </div>
                </div>
            </div>
            </div>
        </div> 
    </div>
</template>

<script>
import route from "@/router"
import router from "@/router"
import { onMounted, ref, computed } from "vue"
import { getLogin } from '@/utils/checkLogin'
import { setReservationHouse, sendEmail } from '@/utils/api'
import { useToast } from "primevue/usetoast"
import { useStore } from 'vuex'
import moment from "moment"

export default ({
    name: 'ConfirmPayment',
    setup() {
        const store = useStore();
        const reservationData = ref([]);
        const toast = useToast();
        const disabledButton = ref(false);

        onMounted(()=>{
            reservationData.value = route.currentRoute.value.params;
            getLogin();
            /* console.log(moment(reservationData.value.arrivalDay+" "+reservationData.value.arrivalTime,'DD-MM-YYYY HH:mm').subtract(2,'days').format('DD/MM/YYYY HH:mm')) */

        });

        const getDayCancelation = computed(()=>{
            return moment(reservationData.value.arrivalDay,'DD-MM-YYYY').subtract(2,'days').format('DD/MM/YYYY');
        })

        const setReservation = async()=>{
            disabledButton.value =true;
            try{
                let response = await setReservationHouse(reservationData.value.arrivalDay,
                                                    reservationData.value.departureDay,
                                                    reservationData.value.taxes,
                                                    reservationData.value.arrivalTime,
                                                    reservationData.value.departureTime,
                                                    reservationData.value.subtotal,
                                                    reservationData.value.totalPrices,
                                                    reservationData.value.user,
                                                    reservationData.value.idHouse)
                        
                console.log(response.data);

                let response2 = await sendEmail(
                    store.state.informationUser.email,
                    reservationData.value.nameHouse,
                    reservationData.value.arrivalDay,
                    reservationData.value.departureDay,
                    reservationData.value.arrivalTime,
                    reservationData.value.departureTime,
                    reservationData.value.subtotal,
                    reservationData.value.taxes,
                    reservationData.value.totalPrices
                );
                console.log(response2.data);
                router.push('/user');
                console.log("Realizado correctamente");
                toast.add({severity:'success', summary: 'Success Message', detail:'Reserva realizada correctamente', life: 3000});
                disabledButton.value = false;
            }catch(e){
                console.log(e);
                toast.add({severity:'error', summary: 'Error Message', detail:'Error al realizar la reserva', life: 3000});
                disabledButton.value.false;
            }
        }

        return { reservationData, setReservation, disabledButton, getDayCancelation }
    },
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';

    h1{
        font-family: $noto-serif;
    }

    .resume{
        position: sticky;
        height: 20rem;
        border: 1px solid #b3b2b2;
        border-radius: 5px 5px;
    }

    img{
        width: 100%;
        object-fit: cover;
        border-radius: 5px 5px;
    }

    .price{
        width: 100%;
    }

    select,input{
        width:80%!important;
    }

    .caducidad, .cvv{
        width: 40%!important;
    }

    button{
        width: 30%;

        @media (min-width: 768px) {
            width: 40%;
        }

        @media (min-width: 960px) {
            width: 30%;
        }
    }

</style>
