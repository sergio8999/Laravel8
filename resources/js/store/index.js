import { createStore } from 'vuex'
import axios from 'axios'

// Create a new store instance.

const store = createStore({
  state(){
      return{
        loggedIn:false,
        informationLogin:[],
        informationUser:[],
        informationLogout:[],
        disabledButton:false
      }      
  },
  mutations:{
    setInformationLogin(state,information){
      state.informationLogin = information;
    },

    setInformationUser(state,user){
      state.informationUser = user;
    },

    setInformationLogout(state,logout){
      state.informationLogout = logout;
    },
    setLoggedIn(state,loggedIn){
      state.loggedIn = loggedIn;
    }
  },
  actions:{

    async login({commit},infor) {
      try{
        let response = await axios.post('/api/login',infor)
        let loggedIn = true; 
        commit('setInformationLogin',response.data);
        commit('setLoggedIn',loggedIn);
        sessionStorage.setItem('informationLogin',JSON.stringify(response.data)); 
        sessionStorage.setItem('loggedIn',JSON.stringify({'loggedIn':true})); 
      }catch(e){
        console.log(e);
      }
      
  },

    async user({commit,state}) {

        let response = await axios.get('/api/user',{headers: {Authorization: 'Bearer ' + state.informationLogin.access_token}});
        console.log(response.data);
        commit('setInformationUser',response.data);
        sessionStorage.setItem('informationUser',JSON.stringify(response.data));
    },

    async logout({commit,state}) {
        let response = await axios.get('/api/logout',{headers: {Authorization: 'Bearer ' + state.informationLogin.access_token}})
        let loggedIn = false;
        commit('setInformationLogout',response.data);
        commit('setLoggedIn',loggedIn);
    }
  }
})

export default store