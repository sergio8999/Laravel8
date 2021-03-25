<template>
    <div>
       <h1>Registro:</h1>
        <p><b>Nombre:</b>{{user.name}}</p>
        <p><b>Email:</b>{{user.email}}</p>
    </div>
</template>

<script>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex'

export default ({
    name:'User',
    data(){
        return {
            
        }
    },
    setup(){
        const store = useStore(); 
        onMounted (()=>{
            store.dispatch('user');
        }) 
        const user = computed(()=> store.state.informationUser);
        return {user};
    }, 
    methods:{

    },    
    components:{
        
    }
})
</script>
