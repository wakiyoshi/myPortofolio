import Vue from 'vue'
import VueRouter from 'vue-router'

import UserHome from './components/pages/user/UserHome.vue'
import Home from './components/pages/Home.vue'
import LoginForm from './components/pages/LoginForm.vue'
import RegisterForm from './components/pages/RegisterForm.vue'
import PasswordReset from './components/pages/PasswordReset.vue'
import ResetPasswordForm from './components/pages/ResetPasswordForm.vue'
import TestComponent from './components/pages/TestComponent.vue'
import Pdp from './components/pages/PDP.vue'
import Plp from './components/pages/PLP.vue'
import PlpCategory from './components/pages/PLPcategory.vue'
import PlpSearch from './components/pages/PLPsearch.vue'





Vue.use(VueRouter)


const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginForm,
  },
  {
    path:'/user-home',
    name:'UserHome',
    component: UserHome,
    },
  {
    path: '/register',
    name:'Register',
    component: RegisterForm
  },
  {
    path: '/reset-password',
    name: 'reset-password',
    component: PasswordReset,
  },
  {
    path: '/reset-password/:token',
    name: 'reset-password-form',
    component: ResetPasswordForm,
  },
  {
    path: '/test',
    component: TestComponent,
  },
  {
    path: '/pdp/:id',
    name:'pdp',
    component: Pdp,
  },
  {
    path: '/plp',
    name:'plp',
    component: Plp,
  },
  {
    path: '/plp/:category',
    name:'plp-category',
    component: PlpCategory,
  },
  {
    path: '/plp/search',
    name:'plp-search',
    component: PlpSearch,
  },


]


const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
