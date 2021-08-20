<template>
    <section class="app">
        <the-header />
        <main class="view">
            <router-view></router-view>
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
    }
}
</script>

<style lang="scss">
    @import '../sass/front/_variables.scss';

   .app {
       background-image: url('../../public/img/drops_texture3.png');

       .view {
           width: 100%;
           height: calc(100vh - (#{$headerHeight} + #{$footerHeight}));
       }
   }

</style>