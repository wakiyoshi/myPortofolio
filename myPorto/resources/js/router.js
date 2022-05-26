import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import HomeComponent from './components/pages/HomeComponent.vue'
import LoginForm from './components/pages/LoginForm.vue'
import RegisterForm from './components/pages/RegisterForm.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: HomeComponent
  },
  {
    path: '/login',
    component: LoginForm
  },
  {
    path: '/register',
    component: RegisterForm
  },


]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
