<template>
    <section class="product-card text-gray-600 pb-5 uppercase tracking-widest relative rounded-xl"
        v-show="product.variants.length > 0"
        @mouseover="showSizes = true"
        @mouseleave="showSizes = false">

        <!-- Discount-->
        <div class="discount absolute top-0 left-0"
            v-if="discount > 0">
            <div class="burst-12 absolute top-4 left-4 w-0 h-0 z-10"></div>
            <span class="absolute top-7 left-5 z-20 text-gray-100 font-semibold">-{{ discount }}%</span>
        </div>
        <!-- /Discount -->

        <!-- Thumbnail&Carousel -->
        <div class="thumb overflow-hidden relative cursor-pointer"
            @mouseover="showCarousel = true"
            @mouseleave="showCarousel = false"
            @click="showProduct(product.id)">

            <img v-show="imgLoaded"
                class="w-full h-full absolute object-contain p-4"
                :src="'storage/' + product.thumb" 
                :alt="product.id + ' thumb'"
                @load="imgLoaded = true"
            >

            <!-- Spinner -->
            <div  class="w-full h-full absolute p-4 flex justify-center items-center">
                <img v-show="!imgLoaded"  src="../../images/spinner.svg" alt="" class=" w-24 h-6">
            </div>
            <!-- /Spinner -->

            <transition name="unzoom-fade">
                <product-carousel 
                    v-if="showCarousel && product.prod_imgs.length > 0"
                    :images="product.prod_imgs" />         
            </transition>
        </div>
        <!-- /Thumbnail&Carousel -->
        
        <!-- Details -->
        <div class="flex flex-col items-center space-y-1">

            <!-- Anime -->
            <span class="text-indigo-500">{{ product.anime.name }}</span>
            <!-- /Anime -->

            <!-- Product name -->
            <span class="font-semibold">{{ product.name }}</span>
            <!-- /Product name -->

            <!-- Color -->
            <!-- <span class="text-sm">{{ product.color }}</span> -->
            <!-- /Color -->

            <!-- Sizes -->
            <div class="overflow-hidden h-6 text-sm font-semibold text-gray-600">
                <div v-if="showSizes">
                    <span v-for="variant, index in product.variants"
                        :key="variant.id">
                        <span v-if="index < product.variants.length - 1">{{ variant.size }},&nbsp;</span>
                        <span v-else >{{ variant.size }}</span>
                    </span>
                </div>
            </div>
            <!-- /Sizes -->

            <!-- Price -->
            <span class="text-sm font-semibold text-gray-100 bg-indigo-500 px-2 py-1 rounded-sm">&euro;{{ product.price }}</span>
            <!-- /Price -->

            <!-- Alternative colors -->
            <div class="flex flex-wrap w-full justify-center space-x-2 pt-2"
                v-if="filteredGroup.length > 0">

                <!-- Single color -->
                <div class="alt-color w-1/6 cursor-pointer border-indigo-300 border-2 hover:bg-indigo-100"
                    v-for="altColor in filteredGroup"
                    :key="altColor.id"
                    @click="showProduct(altColor.id)">                    
                    <div class="alt-thumb relative">
                        <img v-show="altLoaded"
                            class="absolute p-2 object-contain"
                            :src="'storage/' + altColor.thumb" 
                            :alt="altColor.color + ' thumb'"
                            @load="altLoaded = true">

                        <!-- Spinner -->
                        <div  class="w-full h-full absolute flex justify-center items-center">
                            <img v-show="!altLoaded"  src="../../images/spinner.svg" alt="" class=" w-8 h-2">
                        </div>
                        <!-- /Spinner -->
                    </div>
                </div>
                <!-- /Single color -->
            </div>
            <!-- /Alternative colors -->

        </div>
        <!-- /Details -->
    </section>
</template>

<script>
import ProductCarousel from './ProductCarousel.vue';

export default {
    name: 'ProductCard',
    components: {
        ProductCarousel
    },
    props: {
        product: Object
    },
    data() {
        return {
            // prodGroup: [],
            filteredGroup: [],
            discount: 0,
            showCarousel: false,
            showSizes: false,
            imgLoaded: false,
            altLoaded: false
        }
    },
    methods: {
        getAndFilterGroup() {
            axios.get(`api/products/groups/${this.product.prod_group}`)
            .then(
                res => {
                    // this.prodGroup = res.data; 
                    this.filteredGroup = this.filterGroup(res.data);                                                             
                }
            )
            .catch(error => {
                if (error.response) {
                    console.log(error.response);                        
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
            });
        },
        filterGroup(prodGroup) {            
           return prodGroup.filter(product => product.id != this.product.id);
        },
        getDiscount(variants) {
            let currentDiscount = 0;
            variants.forEach(variant => {
                if (variant.discount > currentDiscount) {
                    currentDiscount = variant.discount;
                }
            });
            return currentDiscount;
        },
        showProduct(id) {
            this.$router.push({ name: "product", params: { id }})
        }
    },
    created() {
        this.getAndFilterGroup();
        this.discount = this.getDiscount(this.product.variants);
        // this.filteredGroup = this.filterGroup(this.prodGroup);
    }
}
</script>

<style lang="scss">

    .product-card { 
        transition: .5s;       
        &:hover {
            background-color: theme('colors.white');
            filter: drop-shadow(0 2px 2px theme('colors.gray.300'));
        }

        .thumb {
            // square div
            width: 100%;
            padding-bottom: 100%;
            // /square div
        }
    
        .alt-thumb {
            // square div
            width: 100%;
            padding-bottom: 100%;
            // /square div
        }

        .alt-color {
            transition: .4s;
        }
    
        .burst-12 {
          background: theme('colors.red.600');
          width: 45px;
          height: 45px;
          position: relative;
          text-align: center;
          filter: drop-shadow(0 4px 2px theme('colors.gray.300'));

            &:before,
            &:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 45px;
            width: 45px;
            background: theme('colors.red.600');
            }
    
            &:before {
            transform: rotate(30deg);
            }
            &:after {
            transform: rotate(60deg);
            }
    
        }
    }
    
    .unzoom-fade-enter,
    .unzoom-fade-leave-active {
        scale: 200%;
        opacity: 0;
    }
    .unzoom-fade-enter-active {
    // .unzoom-fade-leave-active {
        transition: all .4s ease;
    }

</style>