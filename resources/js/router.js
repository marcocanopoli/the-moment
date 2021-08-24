import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import ViewHome from './views/ViewHome.vue';
import ViewShop from './views/ViewShop.vue';
import ViewProduct from './views/ViewProduct.vue';
// import VLogin from './components/VLogin.vue';
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
        {
           path: '/products/:id',
           name: 'product',
           component: ViewProduct
        },        
        // {
        //    path: '/user-login',
        //    name: 'login',
        //    component: VLogin
        // },     
        {
            path: '*',
            name: 'not-found',
            component: ViewNotFound
        }
    ]
});

export default router;