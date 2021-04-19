<template>
<div class="d-flex flex-column justify-content-center align-items-center">
     <h1>ERROR 404</h1>
     <h4>No existe la {{params.name}} {{params.id}}</h4>
</div>
</template>

<script>
import route from "@/router"
import { ref } from "vue"

export default({
    name:'Error404',
    data(){
        return {
            
        }
    },
    setup() {
        const params = ref(route.currentRoute.value.query);

        return {params};
    },
})
</script>