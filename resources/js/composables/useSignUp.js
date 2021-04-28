import { useStore } from 'vuex'
import router from "@/router"
import axios from 'axios'
import { useToast } from "primevue/usetoast"

export default function useSignUp(name,email,password) {
    const store = useStore(); 
    const toast = useToast();
    
    const signUp = async ()=>{

        try{
            if(name.value == "")
                toast.add({severity:'warn', summary: 'Error Message', detail:'El campo nombre debe tener un valor', life: 3000}); 
            else if(email.value == "")
                toast.add({severity:'warn', summary: 'Error Message', detail:'El campo email debe tener un correo', life: 3000}); 
            else if(password.value == "")
                toast.add({severity:'warn', summary: 'Error Message', detail:'El campo password debe tener un valor', life: 3000});  
            else{
                store.state.disabledButton = false;
                let res = await axios.post('/api/signUp',{'name':name.value,'email':email.value,'password':password.value});
                toast.add({severity:'success', summary: 'Felicidades!', detail:'Se ha registrado correctamente ' + email.value, life: 3000}); 
                await store.dispatch('login',{'email':email.value,'password':password.value});
                await store.dispatch('user');
                router.push('/user');
                store.state.disabledButton = true;
            }     
        }catch(e){
            toast.add({severity:'error', summary: 'Error Message', detail:e.response.data.errors.email, life: 3000});  
            store.state.disabledButton = true;
        }
    };
  
    return {
        signUp
    };
  }