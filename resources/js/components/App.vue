<template>
    <Toast position="top-center"/>
    <div class="app">
        <theHeader />
        <p>Contador: {{counter}}</p>
        <p>Doble : {{doubleCounter}}</p>
        <button @click="addOne">Sumar</button>
        <router-view></router-view>
        <theFooter />       
    </div>
</template>

<script>
import theHeader from './TheHeader.vue'
import theFooter from './TheFooter.vue'
import {useCounter} from '../composables/useCounter';

export default ({ 
    name:'App',
    data(){
        return {
                
        }
    },
    setup(){
        /* let data = useCounter(); */
        const {
            counter,
            doubleCounter,
            addOne
        } = useCounter();

        return {
            /* counter: data.counter,
            doubleCounter:data.doubleCounter,
            addOne: data.addOne */
            counter,
            doubleCounter,
            addOne
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