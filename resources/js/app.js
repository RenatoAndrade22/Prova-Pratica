/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue').default

import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);

import VueToast from 'vue-toast-notification';

import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast)

import axios from "axios"
window.collect = require('collect.js')

import Layout from "./layout/Layout"
import VueRouter from "vue-router"
import routes from "./routes/index"
Vue.use(VueRouter)

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    render: h => h(Layout),

}).$mount('#app');
