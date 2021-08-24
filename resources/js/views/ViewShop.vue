<template>
    <section class="shop flex h-full"
        v-if="!this.$store.state.loading">
        <!-- Filters -->
        <aside class="w-1/6 bg-yellow-200">

        </aside>
        <!-- /Filters -->

        <!-- Products -->
        <div class="w-5/6 px-3 grid grid-cols-4 gap-3">
            <product-card
                v-for="product in this.$store.state.allProducts"
                :key="product.id"
                :product="product"   
            />
        </div>
        <!-- /Products -->
    </section>
    <v-loader v-else />
</template>

<script>
import VLoader from '../components/VLoader.vue';
import ProductCard from '../components/ProductCard.vue';

export default {
    name: 'ViewShop',
    components: {
        VLoader,
        ProductCard
    },
    // data() {
    //     return {

    //     }
    // },
    created() {
        this.$store.dispatch('getSetProducts');
    }
}
</script>

<style lang="scss">

</style>