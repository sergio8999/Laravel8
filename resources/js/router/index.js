import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'
import Home from '../views/Home.vue'
import Products from '../views/Products.vue'
import Product from '../views/Product.vue'
import About from '../views/About.vue'
import SignUp from '../views/SignUp.vue'
import Login from '../views/TheLogin.vue'
import User from '../views/user.vue'

const routes = [
    { path: '/', name:'home',component: Home },
    { path: '/products', name:'products', component: Products, meta: { requiresAuth: true} },
    { path: '/product/:id', name:'product', component: Product },
    { path: '/signUp', name:'signUp', component: SignUp },
    { path: '/login', name:'login', component: Login },
    { path: '/user', name:'user', component: User },
    { path: '/about', name:'about', component: About },
  ]

  const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
  })

  router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if(!store.state.loggedIn) {
            next("/login");
        } else {
            next();
        }
    } else {
        next();
    }
}) 

  export default router