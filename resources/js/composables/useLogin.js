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
                await store.dispatch('login',{'email':email.value,'password':password.value});
                await store.dispatch('user');
                router.push('/');
            }
        }catch(e){
            toast.add({severity:'error', summary: 'Error Message', detail:'Usuario o contraseña incorrecta', life: 3000}); 
        }
    };
  
    return {
        login
    };
  }