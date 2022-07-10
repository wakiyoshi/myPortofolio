import router from './router';
import Vue from 'vue'
import vuetify from './vuetify'
import App from './components/pages/App.vue'
import store from './store'
import '@mdi/font/css/materialdesignicons.css'

require('./bootstrap');

window.Vue = require('vue').default;


//modules

Vue.component('header-component', require('./components/modules/Header.vue').default);
Vue.component('footer-component', require('./components/modules/Footer.vue').default);
Vue.component('menu-component', require('./components/modules/Menu.vue').default);
Vue.component('campaign-component', require('./components/modules/Campaign.vue').default);
//admins
Vue.component('admin-header-component', require('./components/modules/AdminHeader.vue').default);
//users
Vue.component('user-header-component', require('./components/modules/UserHeader.vue').default);

//pages
Vue.component('home-component', require('./components/pages/Home.vue').default);
Vue.component('login-component', require('./components/pages/LoginForm.vue').default);
Vue.component('register-component', require('./components/pages/RegisterForm.vue').default);
Vue.component('test-component', require('./components/pages/TestComponent.vue').default);
Vue.component('password-reset', require('./components/pages/PasswordReset.vue').default);

Vue.component('pdp-component', require('./components/pages/PDP.vue').default);
Vue.component('plp-component', require('./components/pages/PLP.vue').default);
//users
Vue.component('user-home', require('./components/pages/user/UserHome.vue').default);









const app = new Vue({
    el: '#app',
    router,
    // components: { App }, // ルートコンポーネントの使用を宣言する
    // template: '<App />',
    store,
    vuetify
});
