import { useStore } from 'vuex'

export function getLogin() {
    const store = useStore();
    
    if(sessionStorage)
        if(sessionStorage.getItem('informationUser') != undefined && sessionStorage.getItem('loggedIn') != undefined && sessionStorage.getItem('informationUser') != undefined){
            store.state.informationLogin = JSON.parse(sessionStorage.getItem('informationLogin'));
            store.state.loggedIn = JSON.parse(sessionStorage.getItem('loggedIn'));
            store.state.informationUser = JSON.parse(sessionStorage.getItem('informationUser'));
    }         
  }