<template>
    <footer class="footer flex justify-center items-center bg-gray-900 text-gray-100">
        <span class="text-xl font-semibold">&copy; Nembo 2021</span>
    </footer>
</template>

<script>
export default {
    name: 'TheFooter'
}
</script>

<style lang="scss">

    @import '../../sass/front/_variables.scss';

    .footer{
        height: $footerHeight;
    }

</style>