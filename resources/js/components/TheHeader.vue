<template>
    <header class="header bg-gray-900">
        <nav class="flex flex-col max-w-screen-2xl mx-auto h-full text-gray-100">
            <div class="flex h-1/2 items-center pt-4 space-x-8">
                <a class="h-full flex items-center font-bold text-xl" href="/" id="logo">
                    <img class="h-full mr-4" src="../../images/drop-red.png" alt="Logo">
                    The<span class="text-red-500 hover:text-gray-100">Moment</span>
                </a>
                <form class="searchbar flex flex-grow items-center h-full px-5 text-gray-900 bg-gray-100 rounded-full overflow-hidden ">
                    <input type="text" class="h-full w-full appearance-none bg-transparent focus-visible: outline-none">
                    <button><i class="fas fa-search"></i></button>
                </form>
                <ul class="flex h-full items-center">
                    <li v-if="$store.state.user == null">
                        <button 
                            @click="openLogin" 
                            class="">Login
                        </button>
                        <!-- <router-link :to="{ name: 'login' }">Login</router-link> -->
                    </li>
                    <li v-else>
                        <a href="/">
                            <i class="fas fa-user-circle mr-2"></i>
                            {{ $store.state.user.name }}
                        </a>                        
                    </li>
                    <li>
                        <a href="/"><i class="fas fa-shopping-cart"></i></a>                        
                    </li>
                </ul>

            </div>
            <ul class="flex text-white space-x-8 h-1/2 items-center justify-center">
                <li><router-link :to="{ name: 'home' }">Home</router-link></li>                    
                <li><router-link :to="{ name: 'shop' }">Shop</router-link></li>                   
                <li v-if="$store.state.user">
                    <a href="" @click.prevent="handleLogout">Logout</a>                                              
                </li>   
            </ul>
        </nav>
        <v-modal 
            v-show="isLoginVisible"
            @close="closeLogin">

            <template v-slot:body>
                <form 
                    class="flex flex-col" 
                    @submit.prevent="handleLogin" action="#">
                        <p class="mb-5 text-3xl uppercase text-gray-600">Login</p>
                        <input 
                            id="email" 
                            type="email" 
                            v-model="loginForm.email" 
                            class="mb-5 p-3 w-80 rounded-lg border-2 outline-none"
                            placeholder="Email"
                            required>
                        <input 
                            id="password" 
                            type="password" 
                            v-model="loginForm.password" 
                            class="mb-5 p-3 w-80 rounded-lg border-2 outline-none"
                            placeholder="Password"
                            required > 
                        <div class="mb-5 w-80 ">
                            <input type="checkbox" id="remember">
                            <label class="text-gray-600 pl-1" for="remember">Remember Me</label>
                        </div>

                        <button class="bg-red-600 hover:bg-red-900 text-white font-bold p-2 rounded-lg w-80" id="login" type="submit"><span>Login</span></button>
                </form>
            </template>            
        </v-modal>
    </header>
</template>

<script>
import VModal from './VModal.vue';

export default {
    name: 'TheHeader',
    components: {
        VModal
    },
    data() {
        return {
            isLoginVisible: false,
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
                        this.$store.dispatch('setUser');
                        this.closeLogin();
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
        handleLogout() {
            axios.post('/logout')
                .then(response => {
                    this.$store.commit('SET_USER', null);
                    window.localStorage.removeItem('user');
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
        },
        closeLogin() {
            this.isLoginVisible = false;
        },
        openLogin() {
            this.isLoginVisible = true;
        }
    }
}
</script>

<style lang="scss">

    @import '../../sass/front/_variables.scss';

    .header {
        height: $headerHeight;

        li {
            display: flex;
            height: 100%;

            a {
                display: flex;
                align-items: center;
                padding: 0 16px;
                transition: .2s;
    
                &:hover {
                    color: theme('colors.red.500');
                }
    
                &.active {
                    background-color: theme('colors.red.500');
                }
            }
        }

        .searchbar {
            &:focus-within {
                outline: 2px solid theme('colors.red.500');
            }
        }

    }

</style>