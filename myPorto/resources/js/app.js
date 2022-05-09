import VueRouter from 'vue-router';



require('./bootstrap');

window.Vue = require('vue').default;



Vue.component('home-component', require('./components/HomeComponent.vue').default);
Vue.component('header-component', require('./components/Header.vue').default);
Vue.component('login-component', require('./components/LoginForm.vue').default);
Vue.component('register-component', require('./components/RegisterForm.vue').default);

Vue.component('user-component', require('./components/TestComponent.vue').default);


Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [

    ]
});


const app = new Vue({
    el: '#app',
    router
});
