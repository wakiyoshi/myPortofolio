import router from './router';
import Vue from 'vue'
import vuetify from './vuetify'
import App from './components/pages/App.vue'
import '@mdi/font/css/materialdesignicons.css'
require('./bootstrap');

window.Vue = require('vue').default;


//modules

Vue.component('header-component', require('./components/modules/Header.vue').default);
Vue.component('footer-component', require('./components/modules/Footer.vue').default);
Vue.component('menu-component', require('./components/modules/Menu.vue').default);
Vue.component('campaign-component', require('./components/modules/Campaign.vue').default);
Vue.component('admin-header-component', require('./components/modules/AdminHeader.vue').default);
Vue.component('user-header-component', require('./components/modules/UserHeader.vue').default);


Vue.component('home-component', require('./components/pages/HomeComponent.vue').default);
Vue.component('login-component', require('./components/pages/LoginForm.vue').default);
Vue.component('register-component', require('./components/pages/RegisterForm.vue').default);
Vue.component('test-component', require('./components/pages/TestComponent.vue').default);
Vue.component('password-reset', require('./components/pages/PasswordReset.vue').default);





const app = new Vue({
    el: '#app',
    router,
    components: { App }, // ルートコンポーネントの使用を宣言する
    template: '<App />',
    vuetify
});
