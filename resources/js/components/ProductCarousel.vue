<template>
    <div class="carousel absolute flex justify-center items-center top-0 left-0 w-full h-full bg-white p-4 rounded-xl">
        <!-- parent transition -->
        <transition name="unzoom-fade"> 
            <img
                class="currentImg h-full w-full object-cover rounded-md"
                :src="'storage/' + images[sliderIndex].path" 
                :alt="'Img ' + sliderIndex"
                :key="sliderIndex">
        </transition>
        <!-- /parent transition -->
    </div>
</template>

<script>
export default {
    name: 'ProductCarousel',
    props: {
        images: Array
    },
    data() {
        return {
            sliderIndex: 0,
            carousel: ''
        }
    },
    methods: {
        nextImg() {
            this.sliderIndex++;           
            if (this.sliderIndex == this.images.length) {
                this.sliderIndex = 0;  
            }
        }
    },
    created() {
        this.carousel = setInterval (this.nextImg, 2000);
    }
}
</script>

<style lang="scss">

</style>