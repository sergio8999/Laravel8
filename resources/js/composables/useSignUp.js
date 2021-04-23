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
                let res = await axios.post('/api/signUp',{'name':name.value,'email':email.value,'password':password.value});
                console.log(res.data.message);
                router.push('/');
            }     
        }catch(e){
            console.log(e.response)
        }
    };
  
    return {
        signUp
    };
  }