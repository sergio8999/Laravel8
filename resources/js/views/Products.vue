<template>
    <div>
        <h1>Productos</h1>
        <ul>
            <li v-for="product in products" :key="product.id">
                <router-link :to="{name:'product',params:{id:product.id}}">{{product.name}}</router-link>

            </li>
        </ul>        
        <!-- <Product v-if="$route.params.id!=null"/> -->
    </div>
</template>

<script>
import axios from 'axios'
export default ({
    name:'Products',
    props: [],
    data(){
            return {
                products:[]
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
        }
})
</script>
