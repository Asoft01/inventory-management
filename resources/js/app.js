require('./bootstrap');

// window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Router Imported
import {routes} from './routes';

// Import User Class
import User from './Helpers/User';
window.User = User;

const router = new VueRouter({
    routes,
    mode: 'history'
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    router
});

