import Vue from 'vue';
import Vuex from 'vuex';
import 'es6-promise/auto';
Vue.use(Vuex);

export const store = new Vuex.Store ({
    state: {
        user: null,
        allProducts: [],
        filteredProducts: [],
        loading: false
    },
    mutations: {
        SET_USER (state, user) {
            state.user = user;
            window.localStorage.setItem('user', JSON.stringify(user));
        },
        // GET_STORED_USER (state) {        
        //   const savedUser = window.localStorage.getItem('user');
        //   if(savedUser === null){
        //     state.user = null;
        //   } else {
        //     state.user = JSON.parse(savedUser);
        //   }
        // },
        SET_PRODUCTS (state, products) {
            state.allProducts = products;
        },
        SET_LOADING_TRUE (state) {
            state.loading = true;
        },
        SET_LOADING_FALSE (state) {
            state.loading = false;
        }
    },
    actions: {
        getSetUser({ commit }) {
            axios.get('/api/user')
            .then(
                res => {
                    commit('SET_USER', res.data );                        
                }
            )
            .catch(error => {
                if (error.response) {
                    // Request made and server responded
                    console.log(error.response);                        
                } else if (error.request) {
                    // The request was made but no response was received
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
            });
        },      
        getSetProducts({ commit }) {
            commit('SET_LOADING_TRUE');
            axios.get('/api/products')
            .then(
                res => {
                    commit('SET_PRODUCTS', res.data );                        
                    commit('SET_LOADING_FALSE');
                }
            )
            .catch(error => {
                if (error.response) {
                    console.log(error.response);                        
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
            });
        },
        handleLogout({ commit }) {
            axios.post('/logout')
                .then(() => {
                    commit('SET_USER', null);
                    window.localStorage.removeItem('user');
                })
                .catch(error => console.log(error));            
        },      
    },
    // getters: {
    // 	doneTodos: state => {
    // 	  return state.todos.filter(todo => todo.done)
    // 	}
})
