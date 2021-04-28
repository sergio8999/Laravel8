import { useStore } from 'vuex'
import router from "@/router"
import { useToast } from "primevue/usetoast"

export default function useLogin(email,password) {
    const store = useStore(); 
    const toast = useToast();
    const login = async ()=>{

        try{
            if(email.value == "")
                toast.add({severity:'warn', summary: 'Error Message', detail:'El campo email debe tener un correo', life: 3000}); 
            else if(password.value == "")
                toast.add({severity:'warn', summary: 'Error Message', detail:'El campo password debe tener un valor', life: 3000});  
            else{
                store.state.disabledButton = true;
                await store.dispatch('login',{'email':email.value,'password':password.value});
                await store.dispatch('user');
                toast.add({severity:'success', summary: 'Bienvenido!', detail:'Se ha logueado  ' + email.value, life: 3000});
                router.push('/user');
                store.state.disabledButton = false;
            }
        }catch(e){
            toast.add({severity:'error', summary: 'Error Message', detail:'Usuario o contraseña incorrecta', life: 3000}); 
            store.state.disabledButton = false;
        }
    };
  
    return {
        login
    };
  }