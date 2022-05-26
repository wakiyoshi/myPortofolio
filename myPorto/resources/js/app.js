import router from './router';
import Vue from 'vue'
import vuetify from './vuetify'
import App from './components/pages/App.vue'
import '@mdi/font/css/materialdesignicons.css'
require('./bootstrap');

window.Vue = require('vue').default;


//logout
Vue.component('home-component', require('./components/pages/HomeComponent.vue').default);
Vue.component('header-component', require('./components/modules/Header.vue').default);
Vue.component('footer-component', require('./components/modules/Footer.vue').default);

Vue.component('login-component', require('./components/pages/LoginForm.vue').default);
Vue.component('register-component', require('./components/pages/RegisterForm.vue').default);
Vue.component('menu-component', require('./components/modules/Menu.vue').default);
Vue.component('test-component', require('./components/pages/TestComponent.vue').default);
//user
Vue.component('user-header-component', require('./components/modules/UserHeader.vue').default);

//admin
Vue.component('admin-header-component', require('./components/modules/AdminHeader.vue').default);


const app = new Vue({
    el: '#app',
    router,
    components: { App }, // ルートコンポーネントの使用を宣言する
    template: '<App />',
    vuetify
});
