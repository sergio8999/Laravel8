import { useStore } from 'vuex'

export default function useSignUp(name,email,password) {
    const store = useStore(); 
    
    const signUp = async ()=>{
        try {
            let res = await axios.post('/api/signUp',{'name':name,'email':email,'password':password});
            console.log(res.data.message);
            this.$router.push('/');

        } catch (e) {
             console.log(e.response)
        }
    };
  
    return {
        signUp
    };
  }