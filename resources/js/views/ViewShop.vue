<template>
    <section class="shop flex h-full"
        v-if="!this.$store.state.loading">
        <!-- Filters -->
        <aside class="w-1/6 bg-white p-4 space-y-8 rounded-xl">

            <!-- Anime filters -->
            <div class="anime-filters">
                <span class="block uppercase text-semibold mb-2">Anime</span>
                <div v-for="anime, index in $store.state.animeList"
                    :key="index">
                    <input type="checkbox" :id="anime + '-filter'" :name="anime + '-filter'" :value="anime"
                    v-model="checkedAnime" @change="composeFilterQuery(checkedAnime, 'animeQuery'); getProducts()">
                    <!-- @click="addFilterToQuery('anime', anime, animeQuery)" -->
                    <label :for="anime + '-filter'">{{ anime }}</label>
                </div>
            </div>
            <!-- /Anime filters -->

            <!-- Categories filters -->
            <div class="categories-filters ">
                <span class="block uppercase text-semibold mb-2">Categories</span>
                <div v-for="category, index in $store.state.categoriesList"
                    :key="index">
                    <input type="checkbox" :id="category + '-filter'" :name="category + '-filter'" :value="category"
                    v-model="checkedCategories" @change="composeFilterQuery(checkedCategories, 'categoriesQuery'); getProducts()">
                    <label :for="category + '-filter'">{{ category }}</label>
                </div>
            </div>
            <!-- /Categories filters -->

            <!-- Colors filters -->
            <div class="colors-filters ">
                <span class="block uppercase text-semibold mb-2">Colors</span>
                <div v-for="color, index in $store.state.colorsList"
                    :key="index">
                    <input type="checkbox" :id="color + '-filter'" :name="color + '-filter'" :value="color"
                    v-model="checkedColors" @change="composeFilterQuery(checkedColors, 'colorsQuery'); getProducts()">
                    <label :for="color + '-filter'">{{ color }}</label>
                </div>
            </div>
            <!-- /Colors filters -->

            <!-- Seasons filters -->
            <div class="seasons-filters ">
                <span class="block uppercase text-semibold mb-2">Seasons</span>
                <div v-for="season, index in $store.state.seasonsList"
                    :key="index">
                    <input type="checkbox" :id="season + '-filter'" :name="season + '-filter'" :value="season"
                    v-model="checkedSeasons" @change="composeFilterQuery(checkedSeasons, 'seasonsQuery'); getProducts()">
                    <label :for="season + '-filter'">{{ season }}</label>
                </div>
            </div>
            <!-- /Seasons filters -->

            <!-- Sizes filters -->
            <div class="sizes-filters ">
                <span class="block uppercase text-semibold mb-2">Sizes</span>
                <div v-for="size, index in $store.state.sizesList"
                    :key="index">
                    <input type="checkbox" :id="size + '-filter'" :name="size + '-filter'" :value="size"
                    v-model="checkedSizes" @change="composeFilterQuery(checkedSizes, 'sizesQuery'); getProducts()">
                    <label :for="size + '-filter'">{{ size }}</label>
                </div>
            </div>
            <!-- /Sizes filters -->

        </aside>
        <!-- /Filters -->

        <!-- Products -->
        <div class="w-5/6 ml-8 p-8 grid grid-cols-4 gap-3 bg-white rounded-xl">
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
    data() {
        return {
            checkedAnime: [],
            checkedCategories: [],
            checkedColors: [],
            checkedSeasons: [],
            checkedSizes: [],

            animeQuery: '',
            categoriesQuery: '',
            colorsQuery: '',
            seasonsQuery: '',
            sizesQuery: '',

            searchQuery: ''
        }
    },
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
        composeFilterQuery(checkedFilter, filterQuery) {
            let newQuery = '';
            if (checkedFilter) {
                checkedFilter.forEach(element => {
                    newQuery += element.replace(/\s/g, '+') + ';';
                });
            }
            this[filterQuery] = newQuery.substring(0, newQuery.length - 1).toLowerCase();
        },
        composeSingleSearchQuery(filterQuery, filter) {
            if (filterQuery) {
                if (this.searchQuery == '?') {
                    this.searchQuery += filter + '=' +  filterQuery;
                }else{
                    this.searchQuery += '&'+ filter + '=' +  filterQuery;
                }
            }
        },
        composeSearchQuery() {
            this.searchQuery = '?'
            this.composeSingleSearchQuery(this.animeQuery, 'anime');
            this.composeSingleSearchQuery(this.categoriesQuery, 'categories');
            this.composeSingleSearchQuery(this.colorsQuery, 'color');
            this.composeSingleSearchQuery(this.seasonsQuery, 'season');
            this.composeSingleSearchQuery(this.sizesQuery, 'size');           
        },
        getProducts() {
            this.composeSearchQuery();
            if (this.searchQuery == '?') {
                this.$store.dispatch('getSetProducts');
            }
            else {
                this.$store.dispatch('getSetProducts', this.searchQuery);
            }
;        },
        // addFilterToQuery(filter, value, filterQuery) {
        //     if (filterQuery === '') {
        //         filterQuery = filter + '=' + value + ';';
        //     }
        //     else {
        //         filterQuery += value + ';'
        //     }

        //     this.getProducts(this.query);
        // }

    },
    created() {        
        this.setProductsAndFilters();
    }

}
</script>

<style lang="scss">

</style>