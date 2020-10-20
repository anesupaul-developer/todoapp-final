import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './components/App';
import router from './router';

require('./bootstrap');

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components: {
        App
    },
});
