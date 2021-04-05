import { useStore } from 'vuex'
import router from "@/router"

export default function useSignUp(name,email,password) {
    const store = useStore(); 
    
    const signUp = async ()=>{
        try {
            let res = await axios.post('/api/signUp',{'name':name,'email':email,'password':password});
            console.log(res.data.message);
            router.push('/');

        } catch (e) {
             console.log(e.response)
        }
    };
  
    return {
        signUp
    };
  }