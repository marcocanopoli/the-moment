<template>
    <section class="h-full flex justify-center items-center">
        <form class="form p-10 bg-white rounded-lg flex justify-center items-center flex-col shadow-md" 
            @submit.prevent="handleLogin" action="#">
                <p class="mb-5 text-3xl uppercase text-gray-600">Login</p>
                <input id="email" 
                    type="email" 
                    v-model="formData.email" 
                    class="mb-5 p-3 w-80 rounded-lg border-2 outline-none"
                    placeholder="Email"
                    required>
                <input id="password" 
                    type="password" 
                    v-model="formData.password" 
                    class="mb-5 p-3 w-80 rounded-lg border-2 outline-none"
                    placeholder="Password"
                    required > 
                <div class="mb-5 w-80 ">
                    <input type="checkbox" id="remember">
                    <label class="text-gray-600 pl-1" for="remember">Remember Me</label>
                </div>

                <button class="bg-red-600 hover:bg-red-900 text-white font-bold p-2 rounded-lg w-80" id="login" type="submit"><span>Login</span></button>
        </form>
    </section>
</template>

<script>
export default {
    name: 'ViewLogin',
    data() {
        return {
            // user: null,
            formData: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        handleLogin() {
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                axios.post('/login', this.formData)
                    .then(response => {
                        this.$store.dispatch('setUser');
                        this.$router.push({ name: "shop" })
                    })
                    .catch(error => console.log(error));
            });
        }
    }
}
</script>

<style lang="scss">    
    
    // .form {
	//     animation: scale 0.4s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
    // }

</style>