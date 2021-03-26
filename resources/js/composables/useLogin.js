import { useStore } from 'vuex'
import router from "@/router"

export default function useLogin(email,password) {
    const store = useStore(); 
    
    const login = async ()=>{
        try{
            await store.dispatch('login',{'email':email.value,'password':password.value});
            await store.dispatch('user');
            router.push('/');
        }catch(e){
            console.log(e);
        }
    };
  
    return {
        login
    };
  }