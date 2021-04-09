<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-3">
                <h4 @click="show" id="information">Información usuario</h4>
                <h4 @click="show" id="reservation">Reservas</h4>
            </div>
            <div class="col-9 d-flex flex-column justify-content-center">
                <div v-if="value == 'information'">
                    <h1>Registro:</h1>
                    <p><b>Nombre:</b>{{user.name}}</p>
                    <p><b>Email:</b>{{user.email}}</p>           
                </div>

                <div v-if="value == 'reservation'">
                    <div v-for="reservation in reservations" :key="reservation.id">
                        <p>{{reservation.taxes}}</p>
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
                    console.log(response.data);
                    reservations.value = response.data;
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
