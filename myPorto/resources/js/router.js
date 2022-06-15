import Vue from 'vue'
import VueRouter from 'vue-router'

import UserHome from './components/pages/user/UserHome.vue'
import Home from './components/pages/Home.vue'
import LoginForm from './components/pages/LoginForm.vue'
import RegisterForm from './components/pages/RegisterForm.vue'
import PasswordReset from './components/pages/PasswordReset.vue'
import TestComponent from './components/pages/TestComponent.vue'


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
    meta:{ guestOnly: true }

  },
  {
    path:'/user/home',
    name:'UserHome',
    component: UserHome,
    meta:{ authOnly: true }
},

  {
    path: '/register',
    name:'Register',
    component: RegisterForm


  },
  {
    path: '/password-reset',
    component: PasswordReset,
    meta:{ authOnly: true }
  },
  {
    path: '/test',
    component: TestComponent,

  }


]


const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

function isLoggedIn() {
    return localStorage.getItem("auth");
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authOnly)) {
        if (!isLoggedIn()) {
            next("/login");
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        if (isLoggedIn()) {
            next("/user/home");
        } else {
            next();
        }
    } else {
        next();
    }
});




export default router
