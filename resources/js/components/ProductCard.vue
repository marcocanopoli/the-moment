<template>
    <section class="product-card text-gray-600 pb-5 uppercase tracking-widest relative rounded-xl">

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

            <img 
                class="w-full h-full absolute object-contain p-4"
                :src="'storage/' + product.thumb" 
                :alt="product.id + ' thumb'"
            >
            <transition name="carousel-fade">
                <product-carousel 
                    v-if="showCarousel && product.prod_imgs.length > 0"
                    :images="product.prod_imgs" />         
            </transition>
        </div>
        <!-- /Thumbnail&Carousel -->
        
        <!-- Details -->
        <div class="flex flex-col items-center space-y-1">
            <span class="text-indigo-600">{{ product.anime.name }}</span>
            <span class="font-semibold">{{ product.name }}</span>
            <span class="text-sm">{{ product.color }}</span>
            <span class="text-sm font-semibold">&euro;{{ product.price }}</span>

            <!-- Alternative colors -->
            <div class="flex flex-wrap w-full justify-center space-x-2 pt-2"
                v-if="filteredGroup.length > 0">
                <!-- Single color -->
                <div class="altColor w-1/6 cursor-pointer border-indigo-300 border-2"
                    v-for="altColor in filteredGroup"
                    :key="altColor.id"
                    @click="showProduct(altColor.id)">                    
                    <div class="alt-thumb relative">
                        <img 
                            class="absolute p-2 object-contain"
                            :src="'storage/' + altColor.thumb" 
                            :alt="altColor.color + ' thumb'">
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
            showCarousel: false
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

    .carousel-fade-enter,
    .carousel-fade-leave-active {
        scale: 200%;
        opacity: 0;
    }
    .carousel-fade-enter-active {
    // .carousel-fade-leave-active {
        transition: all .8s ease;
    }

</style>