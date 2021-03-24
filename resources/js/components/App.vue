<template>
    <div>
        <ul>
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/signUp">Registrar</router-link></li>
            <li><router-link to="/login">Login</router-link></li>
            <li><router-link to="/products">Products</router-link></li>
            <li><router-link to="/user">User</router-link></li>
            <li><router-link to="/about">About</router-link></li>
            <router-view ></router-view>
        </ul>       
    </div>
</template>

<script>

export default ({
    name:'Products',
    data(){
            return {
                products: []
            }
        },
    components:{
    },
    methods:{

    },
    mounted(){
            
        }
})
</script>
