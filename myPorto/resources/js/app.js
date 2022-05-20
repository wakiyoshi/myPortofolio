import router from './router';
import Vue from 'vue'
import vuetify from './vuetify'
import App from './components/App.vue'
import '@mdi/font/css/materialdesignicons.css'
require('./bootstrap');

window.Vue = require('vue').default;


//logout
Vue.component('home-component', require('./components/HomeComponent.vue').default);
Vue.component('header-component', require('./components/Header.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);

Vue.component('login-component', require('./components/LoginForm.vue').default);
Vue.component('register-component', require('./components/RegisterForm.vue').default);
Vue.component('menu-component', require('./components/Menu.vue').default);
Vue.component('test-component', require('./components/TestComponent.vue').default);
//user
Vue.component('user-header-component', require('./components/UserHeader.vue').default);

//admin
Vue.component('admin-header-component', require('./components/AdminHeader.vue').default);


const app = new Vue({
    el: '#app',
    router,
    components: { App }, // ルートコンポーネントの使用を宣言する
    template: '<App />',
    vuetify
});
