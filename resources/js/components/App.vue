<template>
    <Toast position="top-center"/>
    <div class="app">
        <theHeader  v-if="!$store.state.administrador"/>
        <router-view></router-view>
        <theFooter v-if="!$store.state.administrador"/>       
    </div>
</template>

<script>
import theHeader from './TheHeader.vue'
import theFooter from './TheFooter.vue'
import router from "@/router"
import { onMounted, ref } from "vue"

export default ({ 
    name:'App',
    data(){
        return {
                
        }
    },
    setup(){
        
        onMounted(()=>{
            console.log(router.currentRoute.value.path == '/')
        })

        return {
           
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