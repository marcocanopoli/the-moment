<template>
    <transition name="modal-fade">
        <div class="modal-backdrop flex justify-center items-center fixed inset-0 bg-black bg-opacity-70 z-20"
            @click.self="$emit('close')">
            <div class="modal p-10 bg-white shadow-lg rounded-lg overflow-x-auto relative">
                <button
                    type="button" 
                    class="absolute top-0 right-0 border-none text-3xl p-3 group-hover:cursor-pointer font-bold text-indigo-500 bg-transparent" 
                    @click="$emit('close')">&times;
                </button>

                <!-- <slot name="header" class="flex p-4">
                </slot> -->

                <slot class="py-2">
                </slot>
                
                <!-- <slot name="footer" class="flex flex-col justify-end p-4">
                    <button
                        type="button"
                        class="text-gray-100 bg-indigo-600 rounded-sm"
                        @click="$emit('close')">Close                
                    </button>
                </slot> -->
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