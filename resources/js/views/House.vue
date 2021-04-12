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
                        <option v-for="hour1 in hours" :key="hour1.value" :disabled="hour1.disabled">{{hour1.value}}</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text input-size" for="inputGroupSelect02">Hora salida: </label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect02" v-model="selectHours2">
                        <option v-for="hour2 in hours" :key="hour2.value">{{hour2.value}}</option>
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
        const selectHours1 = ref('00:00');
        const selectHours2 = ref('00:00');
        const reservations = ref([]);

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

            axios.get('/api/reservation')
            .then(response => {
                reservations.value = response.data.reservations;
            })
        })

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

        const checkDate = ()=>{
            if(value.value == null || value.value[0] == null)
                return false;
            return true;
        };

        const setReservation = ()=>{
            if(loggedIn.value){
                if(checkDate() && totalPrices.value != 0){
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
                    }) 
                    .catch(error => {
                        console.log(error)
                    });
                    console.log("Realizado correctamente");
                    toast.add({severity:'success', summary: 'Success Message', detail:'Reserva realizada correctamente"', life: 3000});
                }else{
                    console.log("Error. Debe seleccionar los dias y horas correctamente");
                    toast.add({severity:'error', summary: 'Error Message', detail:'Error. Debe seleccionar los dias y horas correctamente', life: 3000});
                }                
            }else{
                toast.add({severity:'error', summary: 'Error Message', detail:'Debe estar logueado', life: 3000});
                router.push('/login');
            }
                
        };

        const prueba = ()=>{
            let dateNow = new Date();
            console.log();
        }

        const hours = computed(()=>{
            let hour = [];
            let dateNow = new Date();
            let valueDay;

            if(value.value.length == 0)
                valueDay = dateNow.toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' });
            else
                valueDay  = value.value[0].toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' });

            for(let i=0;i<24;i++){
                hour.push({'value': i+':00','disabled':false});
                if(i <= dateNow.getHours() && dateNow.toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }) == valueDay)
                    hour[i].disabled = true;
            }
            return hour;
        }); 

        const subtotal = computed(()=>{
            return house.value.price * getHours();
        });

        const taxes = computed(()=>{
            return parseFloat((subtotal.value * 0.10).toFixed(2));
        });

        const totalPrices = computed(()=>{
            return subtotal.value + taxes.value;
        });

        const minHour = computed(()=>{
            let actualHour = new Date();
            if(value.value != null)
                if(value[0].getDate() == actualHour.getDate())
                    return ((actualHour.getHours()+1)+':00'); 
            return "00:00";
        });

        return {hours, selectHours1,prueba, selectHours2, value, house, subtotal, taxes, totalPrices, minHour, setReservation};
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
