import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import ViewHome from './views/ViewHome.vue';
import ViewShop from './views/ViewShop.vue';
// import ViewLogin from './views/ViewLogin.vue';
import ViewNotFound from './views/ViewNotFound.vue';

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
           path: '/',
           alias: '/home',
           name: 'home',
           component: ViewHome
        },        
        {
           path: '/shop',
           name: 'shop',
           component: ViewShop
        },        
        // {
        //    path: '/user-login',
        //    name: 'login',
        //    component: ViewLogin
        // },     
        {
            path: '*',
            name: 'not-found',
            component: ViewNotFound
        }
    ]
});

export default router;