<template>
    <form 
        class="flex flex-col text-gray-600 w-80 space-y-5" 
        @submit.prevent="handleLogin" action="#">
            <img 
                class="h-16 object-contain"
                src="../../images/drop-red.png" 
                alt="Login image">
            <div class="text-center">
                <h2 class="mb-2 text-3xl text-center uppercase">Login</h2>
                <p>Please enter your e-mail and password</p>
            </div>
            <input 
                id="email" 
                type="email" 
                v-model="loginForm.email" 
                class="p-3 rounded-lg border-2 outline-none"
                placeholder="Email"
                required>
            <input 
                id="password" 
                type="password" 
                v-model="loginForm.password" 
                class="p-3 rounded-lg border-2 outline-none"
                placeholder="Password"
                required > 
            <div>
                <input type="checkbox" id="remember">
                <label class="pl-1" for="remember">Remember Me</label>
            </div>

            <button class="bg-indigo-500 hover:bg-indigo-800 text-gray-100 font-bold py-2 px-4 rounded-lg w-80" id="login" type="submit"><span>Login</span></button>
    </form>
</template>

<script>
export default {
    name: 'VLogin',
    data() {
        return {
            loginForm: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        handleLogin() {
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                axios.post('/login', this.loginForm)
                    .then(response => {
                        this.$store.dispatch('getSetUser');
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
                    .catch(error => console.log(error));
            });
        },
    }
}
</script>

<style lang="scss">

</style>