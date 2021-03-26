<template>
    <div>
       <h1>Registro:</h1>
        <p><b>Nombre:</b>{{user.name}}</p>
        <p><b>Email:</b>{{user.email}}</p>
    </div>
</template>

<script>
import { onMounted, computed } from 'vue';
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
        onMounted(()=>{
            /* const { user } = useUser(); */
        });

        const user = computed(()=> store.state.informationUser);
        
        return {user};
    }, 
    methods:{

    },    
    components:{
        
    }
})
</script>
