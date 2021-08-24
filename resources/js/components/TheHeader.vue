<template>
    <header class="header bg-gray-900"
        @mouseleave="close('userMenu')">
        <!-- Nav -->
        <nav class="flex flex-col max-w-screen-2xl mx-auto h-full text-gray-100">
            <!-- Nav top -->
            <div class="flex h-1/2 items-center pt-3 space-x-8">

                <!-- Brand -->
                <a class="h-full flex items-center font-bold text-xl" href="/" id="logo">
                    <img class="h-full mr-4" src="../../images/drop-red.png" alt="Logo">
                    The<span class="text-red-500">Moment</span>
                </a>
                <!-- /Brand -->

                <!-- Searchbar -->
                <form class="searchbar flex flex-grow items-center h-full px-5 text-gray-900 bg-gray-100 rounded-full">
                    <input type="text" class="h-full w-full appearance-none bg-transparent focus-visible: outline-none">
                    <button><i class="fas fa-search"></i></button>
                </form>
                <!-- /Searchbar -->

                <!-- User&Cart -->
                <ul class="nav-right flex h-full items-center space-x-4">

                    <!-- Login  -->
                    <li v-if="$store.state.user == null">
                        <button @click="isLoginVisible = true">Login</button>
                    </li>
                    <!-- /Login  -->

                    <!-- User -->
                    <li id="user"
                        class="relative"
                        v-else
                        @mouseover="open('userMenu')">

                        <button                            
                            class="cursor-default h-full">
                            <i class="fas fa-user-circle mr-1"></i>
                            {{ $store.state.user.name }}
                        </button>

                        <!-- UserMenu -->
                        <transition name="fade">        
                            <ul class="user-menu absolute min-w-full bg-gray-100 z-10 rounded-md"
                                v-if="userMenu" 
                                @click="close('userMenu')"
                                @mouseleave="close('userMenu')">  
                                <li>
                                    <!-- <router-link>Profile</router-link> -->
                                    <button>Profile</button>
                                </li>
                                <li>
                                    <button @click="open('confirmLogout')">Logout</button>
                                </li>                        
                            </ul>                        
                        </transition>                       
                        <!-- /UserMenu -->
                    </li>
                    <!-- /User -->

                    <!-- Cart -->
                    <li id="cart">
                        <a href="/"><i class="fas fa-shopping-cart"></i></a>                        
                    </li>
                    <!-- /Cart -->

                </ul>
                <!-- /User&Cart -->

            </div>
            <!-- /Nav top -->

            <!-- Nav bottom -->
            <ul class="nav-bottom flex text-gray-100 h-1/2 items-center justify-center space-x-2 uppercase">
                <li><router-link :to="{ name: 'home' }">Home</router-link></li>                    
                <li><router-link :to="{ name: 'shop' }">Shop</router-link></li> 
            </ul>
            <!-- /Nav bottom -->
        </nav>
        <!-- /Nav -->

        <!-- Login modal -->
        <v-modal 
            v-show="isLoginVisible"            
            @close="close('isLoginVisible')">
            <v-login @close="close('isLoginVisible')" /> 
        </v-modal>
        <!-- /Login modal -->  

        <!-- Logout modal -->
        <v-modal            
            v-show="confirmLogout"            
            @close="close('confirmLogout')">
            <v-logout @close="close('confirmLogout')" />
        </v-modal>
        <!-- /Logout modal -->  

    </header>
</template>

<script>
import VModal from './VModal.vue';
import VLogin from './VLogin.vue';
import VLogout from './VLogout.vue';

export default {
    name: 'TheHeader',
    components: {
        VModal,
        VLogin,
        VLogout
    },
    data() {
        return {
            isLoginVisible: false,
            confirmLogout: false,
            userMenu: false
        }
    },
    methods: {
        open(data) {
            this[data] = true;
        },
        close(data) {            
            this[data] = false;
        }
    }
}
</script>

<style lang="scss">

    @import '../../sass/front/_variables.scss';
    @import '../../sass/front/_animations.scss';

    .header {
        height: $headerHeight;

        li {
            transition: .2s;  

            button, a {
                transition: .2s;    
            }  
        }
        .searchbar {
            &:focus-within {
                outline: 2px solid theme('colors.indigo.500');
            }
        }

        .nav-right {
            a:hover {
                color: theme('colors.indigo.500');
            }

            #user {
                height: 100%;
            }

            .user-menu {
                top: 60px;
                filter: drop-shadow(0 2px 2px rgba(0, 0, 0, .3));;

                li {
                    display: block;
                    padding: 0.75rem 1rem; // move with left of child::before
                    color: theme('colors.indigo.500');

                    &:hover {
                        background-color: theme('colors.indigo.500');
                    }
                    &:hover > button,
                    &:hover > a {
                        color: theme('colors.indigo.100');
                    }

                    &:first-child {
                        border-top-left-radius: 6px;
                        border-top-right-radius: 6px;

                        &::before {
                            content: '';
                            position: absolute;
                            width: 0;
                            height: 0;
                            bottom: 100%;
                            left: calc(1rem + .75rem/3); // move with padding of parent
                            transform: translateX(50%);
                            transition: .2s;
                            border: .75rem solid transparent;
                            border-top: none;
                            border-bottom-color: theme('colors.gray.100');
                        }
                        &:hover::before {
                            border-bottom-color: theme('colors.indigo.500');
                        }
                    }

                    &:last-child {
                        border-bottom-left-radius: 6px;
                        border-bottom-right-radius: 6px;
                    }
                }
            }
        }


        .nav-bottom {
            li {
                display: flex;                

                a {
                    display: flex;
                    align-items: center;
                    padding: 6px 12px;
                    border-radius: 5px;

                    &.active {
                        color: theme('colors.gray.100');
                        background-color: theme('colors.indigo.500');

                        &:hover {
                            background-color: theme('colors.indigo.600');  
                        }
                    }
    
                    &:hover:not(.active) {
                        color: theme('colors.indigo.500');
                    }
                }
            }
        }

    }

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter,
    .fade-leave-active {
        opacity: 0;
    }

</style>