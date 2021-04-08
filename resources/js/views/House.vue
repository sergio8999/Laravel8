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
            <div class="col-4 col-md-2">
                <label for=""><b>Hora llegada:</b></label>
                <input
                v-model="arrivalTime"
                type="time"
                min="00:00"
                max="23:00"
                step="3600"
                />
                <label for="" class="mt-2"><b> Hora salida:</b></label>
                <input
                v-model="departureTime"
                type="time"
                min="0:00"
                max="23:00"
                step="600"
                />
            </div>
            <div class="col-5 mt-md-3 col-md-5">
                <p><b>Subtotal ({{ house.price }}€/h):</b> {{ subtotal }}€</p>
                <p><b>Impuestos:</b> {{ taxes }}€</p>
                <hr />
                <p><b>Total:</b> {{ totalPrices }}€</p>
                <button type="submit" class="btn btn-dark" @click="setReservation">Hacer reserva</button>
            </div>
        </div>

  </div>
</template>

<script>
import axios from 'axios'
import { computed, onMounted } from "vue"
import { usePrimeVue } from "primevue/config"


export default ({
    name:'House',
    data(){
        return {
            house:[],
            value:null,
            arrivalTime:'00:00',
            departureTime:'00:00'
        }
    },
    setup(){
        //CAlendario

        const changeToSpanish = () => {
            const primevue = usePrimeVue();
            primevue.config.locale.accept = 'Aceptar';
            primevue.config.locale.reject = 'Rechazar';
            primevue.config.locale.firstDayOfWeek=1;
        }

        onMounted(() => {
            changeToSpanish();

        })

    },
    mounted(){
        axios.get('/api/house/'+this.$route.params.id)
            .then(response => {
                this.house = response.data;
            }) 
    },
    methods:{
         getHours(){
            if(this.value == null || this.value[0] == null || this.value[1] == null)
                return 0;

            let time1 = this.arrivalTime.split(':');
            let time2 = this.departureTime.split(':');
            let arrival = new Date(this.value[0].getFullYear(), this.value[0].getMonth(),this.value[0].getDate(),time1[0],time1[1]);
            let departure = new Date(this.value[1].getFullYear(), this.value[1].getMonth(),this.value[1].getDate(),time2[0],time2[1]);
            let hours = (departure.getTime() - arrival.getTime()) /(1000*60*60);
            return hours;
        }, 
        setReservation(){
            axios.post('/api/reservation',{
                'arrivalDay' : this.value[0].toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }),
                'departureDay' : this.value[1].toLocaleDateString('es-Es',{ year: 'numeric', month: '2-digit', day: '2-digit' }),
                'taxes' : this.taxes,
                'arrivalTime' : this.arrivalTime,
                'departureTime' : this.departureTime,
                'subtotal' : this.subtotal,
                'total' : this.totalPrices,
                'house_id' : this.house.id
            })
            .then(response => {
                console.log(response.data);
            }) 
            .catch(error => {
                console.log(error)
            });
        } 
    },
    computed:{
        subtotal(){
            return this.house.price * this.getHours();
        }, 
         taxes(){
            return parseFloat((this.subtotal * 0.10).toFixed(2));
        }, 
        totalPrices(){
            return this.subtotal + this.taxes;
        }, 
        minHour(){
            let actualHour = new Date();
            if(this.value != null)
                if(this.value[0].getDate() == actualHour.getDate())
                    return ((actualHour.getHours()+1)+':00'); 
            return "00:00";
        } 
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
</style>
