import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import HomeComponent from './components/HomeComponent.vue'
import LoginForm from './components/LoginForm.vue'

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
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
