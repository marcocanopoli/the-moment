<template>
    <section class="shop">
        <h1>Shop</h1>
    </section>
</template>

<script>
export default {
    name: 'ViewShop',
    props: {
        user: Object
    }
}
</script>

<style lang="scss">    
    .shop {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
</style>