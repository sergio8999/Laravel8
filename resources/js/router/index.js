import { createRouter, createWebHistory } from 'vue-router'
import store from '@/store'
import Home from '@/views/Home.vue'
import Products from '@/views/Products.vue'
import Product from '@/views/Product.vue'
import Houses from '@/views/Houses.vue'
import House from '@/views/House.vue'
import Category from '@/views/Category.vue'
import About from '@/views/About.vue'
import SignUp from '@/views/SignUp.vue'
import Login from '@/views/TheLogin.vue'
import User from '@/views/User.vue'
import error404 from '@/views/404.vue'
import NotFound from '@/views/404.vue'
import ConfirmPayment from '@/views/ConfirmPayment.vue'
import TheLoginAdministrador from '@/views/TheLoginAdministrador.vue'
import Dashboard from '@/components/Dashboard.vue'
import HomeDashboard from '@/views/HomeDashboard.vue'
import AddHouse from '@/views/AddHouse.vue'
import EditHouses from '@/views/EditHouses.vue'
import EditHouse from '@/views/EditHouse.vue'


const routes = [
    { path: '/', name:'home',component: Home },
    { path: '/products', name:'products', component: Products, meta: { requiresAuth: true} },
    { path: '/product/:id', name:'product', component: Product, meta: { requiresAuth: true} },
    { path: '/houses', name:'houses', component: Houses },
    { path: '/house/:id', name:'house', component: House },
    { path: '/category/:id', name:'category', component: Category },
    { path: '/signUp', name:'signUp', component: SignUp },
    { path: '/login', name:'login', component: Login },
    { path: '/user', name:'user', component: User, meta: { requiresAuth: true} },
    { path: '/about', name:'about', component: About },
    { path: '/404', name:'404', component: error404 },
    { path: '/confirmPayment', name:'confirmPayment', component: ConfirmPayment },
    /* { path: '/administrador', name:'theLoginAdministrador', component: TheLoginAdministrador },
    { path: '/dashboard', name:'dashboard', component: Dashboard, children: [
        { path: '',name:'homeDashboard', component: HomeDashboard },
        { path: 'addHouse',name:'addHouse', component: AddHouse },
        { path: 'editHouses',name:'editHouses', component: EditHouses },
        { path: '/editHouse/:id', name:'editHouse', component: EditHouse },


        // ...other sub routes
      ] }, */
    { path: '/:NotFound(.*)*', name:'404', component: NotFound },
  ]

  const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior() {
      document.getElementById('app').scrollIntoView();
  }
  })

  router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if(!store.state.loggedIn && sessionStorage.getItem('loggedIn') == undefined) {
            next("/login");
        } else {
            next();
        }
    } else {
        next();
    }
}) 

  export default router