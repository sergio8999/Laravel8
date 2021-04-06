import { useStore } from 'vuex'
import router from "@/router"
import axios from 'axios'

export default function useSignUp(name,email,password) {
    const store = useStore(); 
    
    const signUp = async ()=>{
        console.log(email.value+password.value);
        try{
            let res = await axios.post('/api/signUp',{'name':name.value,'email':email.value,'password':password.value});
            console.log(res.data.message);
            router.push('/');

        }catch(e){
            console.log(e.response)
        }
    };
  
    return {
        signUp
    };
  }