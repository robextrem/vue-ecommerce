/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter)

window.axios = require('axios').default;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

import GridProduct from './components/GridProducts.vue';
import Product from './components/Product.vue';


//Vue.component('grid', require('./components/GridProducts.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: "home",
            component: GridProduct
        },
        {
            path: '/product/:slug',
            name: "product",
            component: Product,
        },
    ],
});

const app = new Vue({ router }).$mount('#grid-products')

