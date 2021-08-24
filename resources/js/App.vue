<template>
    <section class="app bg-gray-100">
        <the-header />
        <main class="view relative max-w-screen-2xl mx-auto py-14"> 
            <!-- h-px -->
            <router-view ></router-view>
        </main>
        <the-footer />
    </section>
</template>

<script>
import TheHeader from './components/TheHeader.vue';
import TheFooter from './components/TheFooter.vue';

export default {
    name: 'App',
    components: {
        TheHeader,
        TheFooter
    },
    data() {
        return {

        }
    },
    created() {
        if(top.loggedIn){            
            this.$store.dispatch('getSetUser');
        }
    }
}
</script>

<style lang="scss">
    @import '../sass/front/_variables.scss';

   .app {
    //    background-image: url('../images/drops_texture3.png');

       .view {
           min-height: calc(100vh - (#{$headerHeight} + #{$footerHeight}));
       }
   }

</style>