import{createApp} from 'vue'

import App from './components/App.vue'
import router from './router'
import store from './store'
import PrimeVue from 'primevue/config'
import Calendar from 'primevue/calendar'
import ToastService from 'primevue/toastservice';
import Toast from 'primevue/toast'

import 'primevue/resources/themes/saga-blue/theme.css'       //theme
import 'primevue/resources/primevue.min.css'                //core css
import 'primeicons/primeicons.css'                           //icons


createApp(App).use(PrimeVue).use(ToastService).use(router).use(store).component('Toast',Toast).component('Calendar',Calendar).mount('#app')