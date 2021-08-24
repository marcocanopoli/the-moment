<template>
    <section class="logout flex flex-col text-gray-600 space-y-5">
        <h2 class="mb-4 text-3xl text-center uppercase">Logout</h2>
        <div class="flex flex-col text-center">
            <span
                v-if="$store.state.user"
                class="text-xl ">
                Hey, <span class="font-bold text-indigo-500">{{ this.$store.state.user.name }}!</span>
            </span>
            <span class="mb-4 text-xl">Do you really want to log out?</span>
        </div>
        <div class="flex justify-between text-white space-x-4">
            <button
                class="bg-red-500 hover:bg-red-800 font-bold py-2 px-4 rounded-lg"
                @click="logout">Yes, log me out
            </button>
            <button
                class="bg-indigo-500 hover:bg-indigo-800 font-bold py-2 px-4 rounded-lg"
                @click="$emit('close')">No, keep me in
            </button>
        </div>
    </section>
</template>

<script>
export default {
    name: 'VLogout',
    methods: {
        // handleLogout() {
        //     axios.post('/logout')
        //         .then(response => {
        //             this.$store.commit('SET_USER', null);
        //             window.localStorage.removeItem('user');
        //             this.$router.push({ name: "shop" })
        //             .catch(error => {
        //                     if (
        //                         error.name !== 'NavigationDuplicated' &&
        //                         !error.message.includes('Avoided redundant navigation to current location')
        //                     ){
        //                         console.log(error)
        //                     }
        //                 })
        //         })
        //         .catch(error => console.log(error));            
        // },
        logout() {
            this.$store.dispatch('handleLogout')
                .then(() => {
                    this.$emit('close');
                    this.$router.push({ name: "shop" })
                    .catch(error => {
                        if (
                            error.name !== 'NavigationDuplicated' &&
                            !error.message.includes('Avoided redundant navigation to current location')
                        ){
                            console.log(error)
                        }
                    })
                })
        }
    }
}
</script>

<style lang="scss">

</style>>