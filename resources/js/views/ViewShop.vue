<template>
    <section class="shop flex h-full"
        v-if="!this.$store.state.loading">
        <!-- Filters -->
        <aside class="w-1/6 bg-white p-4 space-y-8">

            <!-- Anime filters -->
            <div class="anime-filters">
                <span class="block uppercase text-semibold mb-2">Anime</span>
                <div v-for="anime, index in $store.state.animeList"
                    :key="index">
                    <input type="checkbox" :id="anime + '-filter'" :name="anime + '-filter'" :value="anime">
                    <label :for="anime + '-filter'">{{ anime }}</label>
                </div>
            </div>
            <!-- /Anime filters -->

            <!-- Categories filters -->
            <div class="categories-filters ">
                <span class="block uppercase text-semibold mb-2">Categories</span>
                <div v-for="category, index in $store.state.categoriesList"
                    :key="index">
                    <input type="checkbox" :id="category + '-filter'" :name="category + '-filter'" :value="category">
                    <label :for="category + '-filter'">{{ category }}</label>
                </div>
            </div>
            <!-- /Categories filters -->

            <!-- Colors filters -->
            <div class="colors-filters ">
                <span class="block uppercase text-semibold mb-2">Colors</span>
                <div v-for="color, index in $store.state.colorsList"
                    :key="index">
                    <input type="checkbox" :id="color + '-filter'" :name="color + '-filter'" :value="color">
                    <label :for="color + '-filter'">{{ color }}</label>
                </div>
            </div>
            <!-- /Colors filters -->

            <!-- Seasons filters -->
            <div class="seasons-filters ">
                <span class="block uppercase text-semibold mb-2">Seasons</span>
                <div v-for="season, index in $store.state.seasonsList"
                    :key="index">
                    <input type="checkbox" :id="season + '-filter'" :name="season + '-filter'" :value="season">
                    <label :for="season + '-filter'">{{ season }}</label>
                </div>
            </div>
            <!-- /Seasons filters -->

            <!-- Sizes filters -->
            <div class="sizes-filters ">
                <span class="block uppercase text-semibold mb-2">Sizes</span>
                <div v-for="size, index in $store.state.sizesList"
                    :key="index">
                    <input type="checkbox" :id="size + '-filter'" :name="size + '-filter'" :value="size">
                    <label :for="size + '-filter'">{{ size }}</label>
                </div>
            </div>
            <!-- /Sizes filters -->

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
    methods: {
        async setProductsAndFilters() {
            this.$store.commit('SET_LOADING_TRUE');
            return this.$store.dispatch('getSetProducts')
                .then(() => {
                    return this.$store.dispatch('setPropertiesLists')
                        .then(() => {
                            this.$store.commit('SET_LOADING_FALSE');
                        })
                })
                .catch(err => console.log(err));
        },
    },
    created() {        
        this.setProductsAndFilters();
    },
    computed: {

    },
    watch: {
        
    }

}
</script>

<style lang="scss">

</style>