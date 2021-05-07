<template>
    <Toast position="top-center"/>
    <div class="app">
        <theHeader  v-if="!administrador"/>
        <router-view></router-view>
        <theFooter v-if="!administrador"/>       
    </div>
</template>

<script>
import theHeader from './TheHeader.vue'
import theFooter from './TheFooter.vue'
import router from "@/router"
import { onMounted, ref, computed } from "vue"
import { useStore } from 'vuex'

export default ({ 
    name:'App',
    data(){
        return {
                
        }
    },
    setup(){
        const store = useStore();
        
        onMounted(()=>{
        })

        const administrador = computed(()=>{
            return JSON.parse(sessionStorage.getItem('administrador')) || router.currentRoute.value.name == 'theLoginAdministrador';
        })

        return {
           administrador
        }
    },
    
    components:{
        theHeader,
        theFooter
    },
    methods:{

    },
    mounted(){
            
        }
})
</script>

<style scoped lang="scss">

    .app{
        min-height: 100vh;
        display: grid;
        grid-template-rows: max-content 1fr max-content; 
    }

</style>