import { useStore } from 'vuex'
import { computed } from 'vue'

export default function useUser() {
    
    const user = ()=>{ 
        const store = useStore();
        const user = computed(()=> store.state.informationUser);
        return user; 
    };
  
    return {
        user
    };
  }