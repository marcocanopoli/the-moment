<template>
    <transition name="modal-fade">
        <div class="modal-backdrop flex justify-center items-center fixed inset-0 bg-black bg-opacity-50">
            <div class="modal p-10 bg-gray-100 shadow-lg rounded-lg overflow-x-auto relative">
                <button
                    type="button" 
                    class="absolute top-0 right-0 border-none text-3xl p-4 cursor-pointer font-bold text-red-600 bg-transparent" 
                    @click="$emit('close')">&times;
                </button>
                <!-- <header class="flex p-4">
                    <slot name="header">
                    </slot>
                </header> -->

                <section class="py-2">
                    <slot name="body">
                    </slot>
                </section>

                <!-- <footer class="flex flex-col justify-end p-4">
                    <slot name="footer">
                    </slot>
                    <button
                        type="button"
                        class="text-gray-100 bg-red-600 rounded-sm"
                        @click="$emit('close')">Close                
                    </button>
                </footer> -->
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name : 'VModal'
}
</script>

<style lang="scss">

    .modal-fade-enter,
    .modal-fade-leave-to {
        opacity: 0;
    }

    .modal-fade-enter-active,
    .modal-fade-leave-active {
        transition: opacity .5s ease;
    }

</style>