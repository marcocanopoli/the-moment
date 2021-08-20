import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import ViewHome from './views/ViewHome.vue';

const router = new VueRouter({
    mode: 'history',
    // linkExactActiveClass: 'active',
    routes: [
        {
           path: '/',
           name: 'home',
           component: ViewHome 
        },        
        // {
        //     path: '*',
        //     name: 'not-found',
        //     component: NotFound
        // }
    ]
});

export default router;