window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;

import App from './App.vue';
import router from './router';
import {store} from './store';
import axios from 'axios';

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router : router,
    store : store
});