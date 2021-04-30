import { ref, computed, watch, reactive, toRefs} from 'vue';

export function useCounter(){
    
    /* const counter = ref(0); */
    const data = reactive({
        counter : 0,
        doubleCounter : computed(()=>
            data.counter * 2)
    })

    /* const doubleCounter = computed(()=>{
        return counter.value * 2;
    }) */

    /* function addOne(){
        counter.value +=1;
    } */
    function addOne(){
        data.counter +=1;
    }

    /* watch(counter,(newVal, oldVal)=>{
        console.log(newVal);
    }); */

    return{
        addOne,
        /* doubleCounter,
        addOne */
        ...toRefs(data)
        
    }
}