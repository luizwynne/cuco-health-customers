import Vue from 'vue'
import VueRouter from 'vue-router'
import CustomersPage from '../pages/CustomersPage.vue'
import NewCustomerPage from '../pages/NewCustomerPage.vue'
import EditCustomerPage from '../pages/EditCustomerPage.vue'

Vue.use(VueRouter)

const routes = [
  {
    path:'/', 
    name: 'CustomersPage', 
    component: CustomersPage
  },
  {
    path:'/cadastro', 
    name: 'NewCustomerPage', 
    component: NewCustomerPage
  },
  {
    path:'/editar/:id', 
    name: 'EditCustomerPage', 
    component: EditCustomerPage
  }
]

// eslint-disable-next-line no-new
const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
