<template>
    <section class="home h-full"
        v-if="!loading">
    </section>
    <v-loader v-else></v-loader>        
</template>

<script>
import VLoader from '../components/VLoader.vue';

export default {
    name: 'ViewHome',
    components: {
        VLoader
    },
    data() {
        return {
            loading: true
        }
    }
}
</script>

<style lang="scss">

</style>