<template>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <h1 class="text-center my-3">Inicie sesión:</h1>
        <form class="mb-3" @submit.prevent="login">
            <div class="form-group">
                <label for="exampleInputName1">Nombre</label>
                <input type="text" class="form-control" id="exampleInputName1" v-model="name" placeholder="Introduce nombre">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="password" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn btn-dark btn-size" :disabled="disabledButton">Login</button>
        </form>
        
    </div>
</template>

<script>
import { ref } from 'vue' 
import { loginAdministrador } from '@/utils/api'
import router from "@/router"
import { useToast } from "primevue/usetoast"

export default ({
    name:'TheLoginAdministrador',
    setup() {
        const toast = useToast();
        const name = ref();
        const password = ref();
        const disabledButton = ref(false);

        const login = async()=>{
            
            if(name.value == "")
                toast.add({severity:'warn', summary: 'Error Message', detail:'El campo nombre debe tener un valor', life: 3000}); 
            else if(password.value == "")
                toast.add({severity:'warn', summary: 'Error Message', detail:'El campo password debe tener un valor', life: 3000});  
            else{
                disabledButton.value = true;
                try{
                    let response = await loginAdministrador(name.value, password.value);
                    if(response.data.status){
                        toast.add({severity:'success', summary: 'Bienvenido!', detail: response.data.message + ' ' + name.value, life: 3000});
                        router.push('/dashboard');
                    }else
                        toast.add({severity:'error', summary: 'Error Message', detail: response.data.message, life: 3000});
                    
                    disabledButton.value = false;
                }catch(e){
                    disabledButton.value = false;
                    console.log(e);
                }
            }
        }
        
        return { name, password, login, disabledButton };
    },
})
</script>

<style scoped lang="scss">

    form{
        width: 90%;

        @media (min-width: 960px) {
            width: 30%;
        }
        
        .btn-size{
        width: 100%;
        }
    }

</style>
