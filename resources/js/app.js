import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

window.$ = window.jQuery = require('jquery');
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import 'perfect-scrollbar';

Vue.use(VueRouter);

let app;
app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
