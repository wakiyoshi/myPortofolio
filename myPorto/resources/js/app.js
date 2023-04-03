import router from './router';
import Vue from 'vue'
import vuetify from './vuetify'
import App from './components/pages/App.vue'
import store from './store'
import breadcrumb from "./breadcrumb"
import Vuelidate from 'vuelidate'



import '@mdi/font/css/materialdesignicons.css'


require('./bootstrap');

window.Vue = require('vue').default;


//modules

Vue.component('footer-component', require('./components/modules/Footer.vue').default);
Vue.component('menu-component', require('./components/modules/Menu.vue').default);
Vue.component('campaign-component', require('./components/modules/Campaign.vue').default);
Vue.component('bread-crumb', require('./components/modules/BreadCrumb.vue').default);

//admins
Vue.component('admin-header-component', require('./components/modules/AdminHeader.vue').default);
//users
Vue.component('user-header-component', require('./components/modules/UserHeader.vue').default);

//pages
Vue.component('home-component', require('./components/pages/Home.vue').default);
Vue.component('login-component', require('./components/pages/LoginForm.vue').default);
Vue.component('register-component', require('./components/pages/RegisterForm.vue').default);
Vue.component('test-component', require('./components/pages/TestComponent.vue').default);
Vue.component('password-reset', require('./components/pages/ForgotPassword.vue').default);

Vue.component('pdp-component', require('./components/pages/PDP.vue').default);
Vue.component('plp-component', require('./components/pages/PLP.vue').default);


const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify,
    breadcrumb: breadcrumb,
    Vuelidate,
    
});


if (sessionStorage.getItem('User')) {
        const storageData = JSON.parse(sessionStorage.getItem('User'));
        if (storageData.userAuth.user.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + storageData.userAuth.user.token;
        }
    }

if(sessionStorage.getItem('Admin')){
        const storageData = JSON.parse(sessionStorage.getItem('Admin'));
        if (storageData.adminAuth.admin.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + storageData.adminAuth.admin.token;
        }

    }




