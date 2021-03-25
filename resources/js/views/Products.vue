<template>
    <div>
        <h1>Productos</h1>
        <ul>
            <li v-for="product in products" :key="product.id">
                <router-link :to="{name:'product',params:{id:product.id}}">{{product.name}}</router-link>

            </li>
        </ul>        
    </div>
</template>

<script>
import axios from 'axios'

export default ({
    name:'Products',
    props: [],
    data(){
        return {
            products:[],
        }
    },
    components:{

    },
    methods:{

    },
    mounted(){
        axios.get('api/products')
            .then(response => {
                this.products = response.data;
        })             
    },
    computed:{
        
    }
})
</script>
