import{createApp} from 'vue'

import App from './components/App.vue'
import router from './router'
import store from './store'
import PrimeVue from 'primevue/config'
import Calendar from 'primevue/calendar';


createApp(App).use(PrimeVue).use(router).use(store).component('Calendar',Calendar).mount('#app')