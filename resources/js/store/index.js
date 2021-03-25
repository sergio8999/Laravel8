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
          let res = await axios.post('/api/login',infor)
          let information = await res.data;
          let loggedIn = true;
          console.log(information);
          commit('setInformationLogin',information);
          commit('setLoggedIn',loggedIn);
          return res;
  },

    async user({commit,state}) {

        let res = await axios.get('/api/user',{headers: {Authorization: 'Bearer ' + state.informationLogin.access_token}});
        let information = await res.data;
        console.log(information);
        commit('setInformationUser',information);
    },

    async logout({commit,state}) {
        let res = await axios.get('/api/logout',{headers: {Authorization: 'Bearer ' + state.informationLogin.access_token}})
        let information = await res.data;
        let loggedIn = false;
        commit('setInformationLogout',information);
        commit('setLoggedIn',loggedIn);
    }
  }
})

export default store