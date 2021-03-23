import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Products from '../views/Products.vue'
import About from '../views/About.vue'

const routes = [
    { path: '/', name:'home',component: Home },
    { path: '/products/', name:'products', component: Products },
    { path: '/products/:id', name:'product', component: Products },
    { path: '/about', name:'about', component: About },
  ]

  const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
  })

  export default router