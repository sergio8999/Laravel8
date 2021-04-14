<template>
  <div class="container">
    <div class="d-flex flex-column justify-content-center align-items-center">
      <h1>{{ house.name }}</h1>
      <img :src="`/images/${house.url}`" alt="" />
    </div>
    <div class="mt-4">
      <h3>Anfitrión: {{ house.host }}</h3>
      <p>{{ house.description }}</p>
    </div>
    <h4>Dia llegada - salida</h4>
        <div class="row my-3">
            <div class="col-12 col-md-5">
                <Calendar
                v-model="value"
                :inline="true"
                :disabledDates="invalidDates"
                :min-date="new Date()"
                :stepMinute="60"
                selectionMode="range"
                />
            </div>
            <div class="col-4 col-md-3">
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

            <div class="col-5 col-md-4">
                <p><b>Subtotal ({{ house.price }}€/h):</b> {{ subtotal }}€</p>
                <p><b>Impuestos:</b> {{ taxes }}€</p>
                <hr />
                <p><b>Total:</b> {{ totalPrices }}€</p>
                <button type="submit" class="btn btn-dark" @click="setReservation">Hacer reserva</button>
            </div>
        </div>
        <button @click="prueba">Prueba</button>
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
        const value = ref([]);

        const changeToSpanish = () => {
            const primevue = usePrimeVue();
            primevue.config.locale.accept = 'Aceptar';
            primevue.config.locale.reject = 'Rechazar';
            primevue.config.locale.firstDayOfWeek=1;
        }

        onMounted(() => {
             changeToSpanish();
             axios.get('/api/house/'+route.currentRoute.value.params.id)
            .then(response => {
                house.value = response.data;
            }) 

            axios.post('/api/reservation/allReservationHouse',{'house_id' : route.currentRoute.value.params.id})
            .then(response => {
                reservations.value = response.data.reservation;
                disabledDates();
            })

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

                    axios.post('/api/reservation',{
                        'arrivalDay' : value.value[0].toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }),
                        'departureDay' : value.value[1].toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }),
                        'taxes' : taxes.value,
                        'arrivalTime' : selectHours1.value,
                        'departureTime' : selectHours2.value,
                        'subtotal' : subtotal.value,
                        'total' : totalPrices.value,
                        'user_id' : user.value.id,
                        'house_id' : house.value.id
                    })
                    .then(response => {
                        console.log(response.data);
                        router.push('/');
                        console.log("Realizado correctamente");
                        toast.add({severity:'success', summary: 'Success Message', detail:'Reserva realizada correctamente"', life: 3000});
                    }) 
                    .catch(error => {
                        console.log(error)
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

        const prueba = ()=>{
        
        }

        const subtotal = computed(()=>{
            return house.value.price * getHours();
        });

        const taxes = computed(()=>{
            return parseFloat((subtotal.value * 0.10).toFixed(2));
        });

        const totalPrices = computed(()=>{
            return subtotal.value + taxes.value;
        });

        return {hoursArrival, prueba, hoursDeparture, selectHours1, invalidDates, selectHours2, value, house, subtotal, taxes, totalPrices, setReservation};
    },
    mounted(){
        
    },
    methods:{

    },
    computed:{

    }
})
</script>
<style scoped>
    img {
        width: 100%;
        height: 30rem;
    }
    .special-day {
        text-decoration: line-through;
    }
    .input-size{
        width: 7rem;
    }
</style>
