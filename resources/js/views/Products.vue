<template>
    <div>
        <h1>Esto es el Producto: </h1>

        <Product v-if="$route.params.id!=null"/>
    </div>
</template>

<script>
import Product from '../components/Product.vue'
export default ({
    name:'Products',
    components:{
        Product
    }
})
</script>
