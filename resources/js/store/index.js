import { createStore } from 'vuex'
import axios from 'axios'

// Create a new store instance.
const store = createStore({
  state:{
      count: 3,
      informationLogin:[]
  },
  mutations:{
        setInformationLogin(state,login){
          state.informationLogin = login;
        }
  },
  actions:{
    async login({commit},infor) {
      try {
        console.log(infor);
          let res = await axios.post('/api/login',infor)
          let information = await res.data;
          commit('setInformationLogin',information);
  
      } catch (e) {
          console.log(e.response) 
      }
  },
  }
})

export default store