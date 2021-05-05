<template>
    <div v-if="house.length !=0">

      <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li class="breadcrumb-item"><router-link to="/houses">Houses</router-link></li>
                <li class="breadcrumb-item active" aria-current="page">House {{house.id}}</li>
            </ol>
        </nav>
        <div class="container">
            <router-link class="btn bg-dark text-light previous" tag="button" to="/houses"><i class="fas fa-arrow-left"></i></router-link>
            <div class="d-flex flex-column justify-content-center align-items-center">
            <h1 class="tittle mt-3">{{ house.name }}</h1>

                <!-- Carousel -->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators carousel" :data-slide-to="0" class="active"></li>
                        <li v-for="number in sizeCarousel" :key="number" data-target="#carouselExampleIndicators" :data-slide-to="number"></li>
                    </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" >
                        <img :src="`/storage/${house.url}`" class="d-block w-100" alt="...">
                    </div>

                    <div v-for="image in images" :key="image.id" class="carousel-item">
                        <img :src="`/storage/${image.url}`" class="d-block w-100" alt="...">
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
            </div>
            <div class="mt-4">
            <h3 class="text">Anfitrión: {{ house.host }}</h3>
                <div class="d-flex justify-content-center justify-content-md-start" v-if="details != undefined">
                    <span class="ml-2">{{details.guests}} Huéspedes</span> 
                    <span class="ml-2">·</span>
                    <span class="ml-2">{{details.bedrooms}} dormitorio/s</span>
                    <span class="ml-2">·</span>
                    <span class="ml-2">{{details.beds}} cama/s</span>
                    <span class="ml-2">·</span>
                    <span class="ml-2">{{details.toilets}} baño/s</span>
                </div>
                <p class="text">{{ house.description }}</p>
                <h5 class="text">Servicios:</h5>
                <div class="d-flex flex-column mb-4 align-items-center align-items-md-start" v-if="details != undefined">
                    <span v-if="details.wifi == 'true'"><i class="pi pi-wifi icon mb-3 mr-2"></i>Wifi</span>
                    <span v-if="details.pool == 'true'"><img class="icon mr-2" src="/storage/iconoPiscina.svg" alt="icono piscina">Piscina</span>
                </div>
            </div>

            <h4 class="text">Dia llegada - salida</h4>
                <div class="row my-3">
                    <div class="col-12 col-md-6 col-lg-5 d-flex justify-content-center align-items-center">
                        <Calendar
                        v-model="value"
                        :inline="true"
                        :disabledDates="invalidDates"
                        :min-date="new Date()"
                        :stepMinute="60"
                        selectionMode="range"
                        />
                    </div>
                    <div class="col-12 col-md-6 col-lg-7">
                        <div class="row mt-3 mt-md-0">
                            <div class="offset-1 col-10 offset-md-0 col-md-12 col-lg-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text input-size" for="inputGroupSelect01">Hora llegada: </label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" v-model="selectHours1">
                                        <option v-for="hour1 in hoursArrival" :key="hour1.value" :disabled="hour1.disabled">{{hour1.value}}</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text input-size" for="inputGroupSelect02">Hora salida: </label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect02" v-model="selectHours2">
                                        <option v-for="hour2 in hoursDeparture" :key="hour2.value" :disabled="hour2.disabled">{{hour2.value}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 offset-lg-1 col-lg-5 d-flex flex-column align-items-center align-items-md-start">
                                <p><b>Subtotal ({{ house.price }}€/h):</b> {{ subtotal }}€</p>
                                <p><b>Impuestos:</b> {{ taxes }}€</p>
                                <p><b>Total:</b> {{ totalPrices }}€</p>
                                <button type="submit" class="btn btn-dark" @click="setReservation">Hacer reserva</button>
                            </div>
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
import { computed, onMounted, ref } from "vue"
import { usePrimeVue } from "primevue/config"
import { useToast } from "primevue/usetoast"
import route from "@/router"
import router from "@/router"
import { useStore } from 'vuex'
import moment from 'moment'
import { getHouse, getReservationsHouse, setReservationHouse } from '@/utils/api'
import { getLogin } from '@/utils/checkLogin'

export default ({
    name:'House',
    data(){
        return {
            
        }
    },
    setup(){
        const store = useStore();
        const user = computed(()=> store.state.informationUser);
        const loggedIn = computed(()=> store.state.loggedIn);
        const toast = useToast();

        const selectHours1 = ref('0:00');
        const selectHours2 = ref('0:00');
        const reservations = ref([]);
        const invalidDates =ref([]);

        const house = ref([]);
        const sizeCarousel = ref([]);
        const details = ref([]);
        const images = ref([]);
        const value = ref([]);

        const changeToSpanish = () => {
            const primevue = usePrimeVue();
            primevue.config.locale.accept = 'Aceptar';
            primevue.config.locale.reject = 'Rechazar';
            primevue.config.locale.firstDayOfWeek=1;
            primevue.config.locale.dayNames= ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
            primevue.config.locale.dayNamesShort= ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sáb"];
            primevue.config.locale.dayNamesMin= ["Do","Lu","Ma","Mi","Ju","Vi","Sa"];
            primevue.config.locale.monthNames= ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
            primevue.config.locale.monthNamesShort= ["Ene", "Feb", "Mar", "Abr", "May", "Jun","Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
        }

        onMounted(async() => {
            changeToSpanish();
            getLogin();
             

            try{
                let response = await getHouse(route.currentRoute.value.params.id)
                if(response.data.house ==  404)
                    router.push({path:'/404',query:{id:route.currentRoute.value.params.id,name:'casa'}});
                else{
                    house.value = response.data.house;
                    details.value = response.data.house.details;
                    sizeCarousel.value = setSizeCarousel();
                    images.value = response.data.house.images;
                }
            }catch(e){
                console.log(e);
            }

            try{
                let response = await getReservationsHouse(route.currentRoute.value.params.id);
                reservations.value = response.data.reservation;
                disabledDates();
            }catch(e){
                console.log(e);
            }
            
        })

        // Obtener horas entre la diferencia de fechas
        const getHours = ()=>{
            if(value.value == null || value.value[0] == null )
                return 0;

            let time1 = selectHours1.value.split(':');
            let time2 = selectHours2.value.split(':');
            
            let arrival = new Date(value.value[0].getFullYear(), value.value[0].getMonth(),value.value[0].getDate(),time1[0],time1[1]);
            let departure;

            if(value.value[1] == null)
                departure = new Date(value.value[0].getFullYear(), value.value[0].getMonth(),value.value[0].getDate(),time2[0],time2[1]);
            else
                departure = new Date(value.value[1].getFullYear(), value.value[1].getMonth(),value.value[1].getDate(),time2[0],time2[1]);
            
            let hours = (departure.getTime() - arrival.getTime()) /(1000*60*60);
            return hours;
        };

        // Comprobar que hay un dia seleccionado
        const checkDate = ()=>{
            if(value.value[0] == undefined)
                return false;
            return true;
        };
        
        // Comprobar si existe reserva entre las fechas seleccionadas
        const checkDateReservation = ()=>{
            let status = true;
            if(value.value[1] == null)
                value.value[1] = value.value[0];

            invalidDates.value.forEach(element => {
                if(value.value[0].getTime() < element.getTime() && value.value[1].getTime() > element.getTime())
                    status = false;  
            }); 

             reservations.value.forEach(element => {
                let dayReservation1 = element.arrivalDay.split('/');

                let timeReservation1 = element.arrivalTime.split(':');

                let dateReservation1 = new Date(dayReservation1[2],parseInt(dayReservation1[1])-1,dayReservation1[0],timeReservation1[0],timeReservation1[1]);

                let timeCalendar1 = selectHours1.value.split(':');
                let timeCalendar2 = selectHours2.value.split(':');

                let dateCalendar1 = new Date(value.value[0].getFullYear(),value.value[0].getMonth(),value.value[0].getDate(),timeCalendar1[0],timeCalendar1[1]);
                let dateCalendar2 = new Date(value.value[1].getFullYear(),value.value[1].getMonth(),value.value[1].getDate(),timeCalendar2[0],timeCalendar2[1]);

                if(dateCalendar1.getTime() <= dateReservation1.getTime() && dateCalendar2.getTime() >= dateReservation1.getTime()){
                    status = false;  
                }
        
            });  
        
            return status;
        };


        const setSizeCarousel = ()=>{
            let size = [];
            for(let i=1;i<=house.value.images.length;i++){
                    size.push(i);
            }
            return size;
        }

        // Hacer reservas con sus correspondientes comprobaciones
        const setReservation = ()=>{
            if(loggedIn.value){
                if(!checkDate())
                    toast.add({severity:'error', summary: 'Error Message', detail:'Debe seleccionar dias', life: 3000}); 
                else if(!checkDateReservation()){
                    toast.add({severity:'error', summary: 'Error Message', detail:'Hay una o varias reservas entre esos dias', life: 3000});                    
                }else if( totalPrices.value > 0){
                    if(value.value[1] == null)
                        value.value[1] = value.value[0];

                    router.push({
                        name: "confirmPayment",
                        params:{
                            arrivalDay:value.value[0].toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }),
                            departureDay:value.value[1].toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }),
                            taxes:taxes.value,
                            arrivalTime:selectHours1.value,
                            departureTime:selectHours2.value,
                            subtotal:subtotal.value,
                            totalPrices:totalPrices.value,
                            user:user.value.id,
                            idHouse:house.value.id,
                            nameHouse:house.value.name,
                            price:house.value.price,
                            beds:details.value.beds,
                            toilets:details.value.toilets,
                            image:house.value.url
                        }
                    });

                }else{
                    console.log("Error. Debe seleccionar los dias y horas correctamente");
                    toast.add({severity:'error', summary: 'Error Message', detail:'Error. Debe seleccionar los dias y horas correctamente', life: 3000});
                }                
            }else{
                toast.add({severity:'error', summary: 'Error Message', detail:'Debe estar logueado', life: 3000});
                router.push('/login');
            }
                
        };

        // Obtener horas de llegada
        const hoursArrival = computed(()=>{
            return setHours('arrival');
        }); 

        // Obtener horas de salida
        const hoursDeparture = computed(()=>{
            return setHours('departure');
        }); 

        // Método para obtener las horas y si se deshabilita 
        const setHours = (day)=>{
            let hour = [];
            let dateNow = new Date();
            let valueDay;

            if(value.value.length == 0 || value.value[0]  == undefined)
                valueDay = dateNow.toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' });
            else
                valueDay  = value.value[0].toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' });

            for(let i=0;i<24;i++){
                hour.push({'value': i+':00','disabled':false});
                if(day == 'arrival'){
                    if(i <= dateNow.getHours() && dateNow.toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }) == valueDay  || checkHourReservation('arrivalDay',hour[i].value))
                        hour[i].disabled = true;
                }else{
                    if(i <= dateNow.getHours()+1 && dateNow.toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }) == valueDay || value.value[1]==null && i <= parseInt(selectHours1.value) || checkHourReservation('departureDay',hour[i].value))
                        hour[i].disabled = true;
                }
            }

            return hour;
        }

        // Checkear para deshabilitar las horas de llegada y salida respectivamente
        const checkHourReservation = (day,hour)=>{
            let status = false;

            if(value.value[0] != undefined)
                reservations.value.forEach(element => {
                    if(day == 'arrivalDay' || value.value[1] == undefined){
                        if(moment(value.value[0],'DD-MM-YYYY '+ hour).format('DD/MM/YYYY') == element.arrivalDay ){
                            if(parseInt(element.arrivalTime) <= parseInt(hour) && parseInt(element.departureTime) >= parseInt(hour) || parseInt(element.arrivalTime) <= parseInt(hour) && element.arrivalDay != element.departureDay )
                                status = true;
                        }else if(moment(value.value[0],'DD-MM-YYYY '+ hour).format('DD/MM/YYYY') == element.departureDay && parseInt(hour) <= parseInt(element.departureTime)) 
                            status = true;
                    }else{
                        if(moment(value.value[1],'DD-MM-YYYY').format('DD/MM/YYYY') == element.departureDay){
                            if(parseInt(element.arrivalTime) <= parseInt(hour) && parseInt(element.departureTime) >= parseInt(hour) && element.arrivalDay == element.departureDay || parseInt(element.departureTime) >= parseInt(hour) && element.arrivalDay != element.departureDay)
                                status = true;
                            } 
                    }
                });

            return status;
        }

        // Añadir dias para deshabilitar en el calendario
        const disabledDates = ()=>{
            reservations.value.forEach(element => {
                let arrivalDay = element.arrivalDay.split('/');
                let dateArrival = new Date(arrivalDay[2],arrivalDay[1],arrivalDay[0]);

                let departureDay = element.departureDay.split('/');
                let dateDeparture = new Date(departureDay[2],departureDay[1],departureDay[0]);

                if(element.arrivalDay != element.departureDay){
                    if(element.arrivalTime == '0:00')
                        invalidDates.value.push(new Date(arrivalDay[2],parseInt(arrivalDay[1])-1,arrivalDay[0]));
            
                    if(element.departureTime == '23:00')
                        invalidDates.value.push(new Date(departureDay[2],parseInt(departureDay[1])-1,departureDay[0]));

                    for(let i=dateArrival.getMonth(); i<=dateDeparture.getMonth(); i++) 
                        for(let j=dateArrival.getDate()+1; j<dateDeparture.getDate();j++){
                            invalidDates.value.push(new Date(arrivalDay[2],i-1,j)); 
                        }
                }
            });
        };

        const subtotal = computed(()=>{
            return parseFloat((house.value.price * getHours()).toFixed(2));
        });

        const taxes = computed(()=>{
            return parseFloat((subtotal.value * 0.10).toFixed(2));
        });

        const totalPrices = computed(()=>{
            return parseFloat((subtotal.value + taxes.value).toFixed(2));
        });

        return {hoursArrival, hoursDeparture, selectHours1, invalidDates, selectHours2, value, house, details, subtotal, taxes, totalPrices, setReservation, sizeCarousel, images};
    },
    mounted(){
        
    },
    methods:{

    },
    computed:{

    }
})
</script>
<style scoped lang="scss">
@import '../../scss/app.scss';

    .text{
        text-align: center;
        @media (min-width: 960px) {
            text-align:left;
        }
    }

    .previous{
        width: 5rem;
    }

    .carousel{
        width: 60%;
    }

    .tittle{
        text-align: center;
        font-family: $noto-serif;
    }

 /*    img {
        width: auto;
        height: 30rem;
    } */
    .special-day {
        text-decoration: line-through;
    }
    .input-size{
        width: 7rem;
    }

    .icon{
        width: 1.7rem;
        height: 1.7rem;
        font-size: 1.5rem;
    }

</style>
