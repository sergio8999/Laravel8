import{createApp} from 'vue'

import App from './components/App.vue'
import router from './router'
import store from './store'
import PrimeVue from 'primevue/config'
import Calendar from 'primevue/calendar'

import 'primevue/resources/themes/saga-blue/theme.css'       //theme
import 'primevue/resources/primevue.min.css'                //core css
import 'primeicons/primeicons.css'                           //icons


createApp(App).use(PrimeVue).use(router).use(store).component('Calendar',Calendar).mount('#app')