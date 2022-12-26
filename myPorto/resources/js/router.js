import Vue from 'vue'
import VueRouter from 'vue-router'


import Home from './components/pages/Home.vue'
import LoginForm from './components/pages/LoginForm.vue'
import RegisterForm from './components/pages/RegisterForm.vue'

import GoogleRedirect from './components/pages/oauth/GoogleRedirect.vue'
import GoogleCallback from './components/pages/oauth/GoogleCallback.vue'
import GithubRedirect from './components/pages/oauth/GithubRedirect.vue'
import GithubCallback from './components/pages/oauth/GithubCallback.vue'

import ForgotPassword from './components/pages/ForgotPassword.vue'
import ResetPasswordForm from './components/pages/ResetPasswordForm.vue'
import TestComponent from './components/pages/TestComponent.vue'
import Pdp from './components/pages/PDP.vue'
import Plp from './components/pages/PLP.vue'

import Wishlist from './components/pages/user/Wishlist.vue'
import Cart from './components/pages/user/Cart.vue'
import UserInformation from './components/pages/user/UserInformation.vue'


//admin
import AdminLogin from './components/pages/admin/Login.vue'
import AdminHome from './components/pages/admin/Home.vue'
import AdminMessage from './components/pages/admin/Message.vue'
import AdminMessageIndex from './components/pages/admin/MessageIndex.vue'
import AdminProduct from './components/pages/admin/Product.vue'
import AdminProductIndex from './components/pages/admin/ProductIndex.vue'

import PaymentInformation from './components/pages/user/PaymentInformation.vue'
import PaymentConfirmation from './components/pages/user/PaymentConfirmation.vue'
import PaymentComplete from './components/pages/user/PaymentComplete.vue'

import UserMessage from './components/pages/user/UserMessage.vue'

Vue.use(VueRouter)


const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta:{
        breadcrumb: 'TOP'
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginForm,
  },
  {
    path: '/google-redirect/',
    name: 'google-redirect',
    component: GoogleRedirect,
  },
  {
    path: '/google-callback',
    name: 'google-callback',
    component: GoogleCallback,
  },

  {
    path: '/github-redirect',
    name: 'github-redirect',
    component: GithubRedirect,
  },
  {
    path: '/github-callback',
    name: 'github-callback',
    component: GithubCallback,
  },

  {
    path: '/register',
    name:'Register',
    component: RegisterForm
  },
  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: ForgotPassword,
  },
  {
    path: '/reset-password/:token/:email',
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
    meta:{
        breadcrumb: {
        label: '商品一覧',
        parent: 'plp'
        }
    }
  },
  {
    path: '/plp/category/:category',
    name:'plp-category',
    component: Plp,
    meta:{
        breadcrumb: {
            label: "カテゴリー商品",
            parent:"plp",

    }
    }
  },
  {
    path: '/plp/search',
    name:'plp-search',
    component: Plp,
    meta:{
        breadcrumb: {
            label: "検索結果",
            parent:"plp",
        }
    }
    },
  {
    path: '/plp',
    name:'plp',
    component: Plp,
    meta:{
        breadcrumb: {
        label: '商品一覧',
        parent: 'Home'
        }
    }
  },
  {
    path: '/payment-information',
    name:'payment-information',
    component: PaymentInformation,
  },
  {
    path: '/payment-confirmation',
    name:'payment-confirmation',
    component: PaymentConfirmation,
  },
  {
    path: '/payment-complete',
    name:'payment-complete',
    component: PaymentComplete,
  },
  {
    path: '/user-message',
    name: 'user-message',
    component: UserMessage
  },
  {
    path: '/wishlist',
    name: 'wishlist',
    component: Wishlist
  },
  {
    path: '/cart',
    name: 'cart',
    component: Cart
  },

  {
    path: '/user-information',
    name: 'user-information',
    component: UserInformation
  },



  //admin
  {
    path: '/admin-login',
    name:'admin-login',
    component: AdminLogin,

  },
  {
    path: '/admin-home',
    name:'admin-home',
    component: AdminHome,
  },
  {
    path: '/admin-message/:id',
    name:'admin-message',
    component: AdminMessage,
  },
  {
    path: '/admin-message-index',
    name:'admin-message-index',
    component: AdminMessageIndex,
  },
  {
    path: '/admin-product',
    name:'admin-product',
    component: AdminProduct,
  },
  {
    path: '/admin-product-index',
    name:'admin-product-index',
    component: AdminProductIndex,
  },

]




const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})



export default router
