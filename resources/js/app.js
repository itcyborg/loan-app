import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue';

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import VueToast from 'vue-toast-notification';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-sugar.css';
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import 'perfect-scrollbar';

Vue.use(VueToast);

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

window.$ = window.jQuery = require('jquery');

Vue.use(VueRouter);

let app;
app = new Vue({
    el: '#app',
    linkActiveClass: "active",
    router: new VueRouter(routes)
});
