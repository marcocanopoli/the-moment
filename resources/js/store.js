import Vue from 'vue';
import Vuex from 'vuex';
import 'es6-promise/auto';
Vue.use(Vuex);

export const store = new Vuex.Store ({
    state: {
        user: null,
        allProducts: [],
        // filteredProducts: [],
        loading: false,
        animeList: [],
        categoriesList: [],
        colorsList: [],
        seasonsList: [],
        sizesList: [],
    },
    mutations: {
        SET_USER (state, user) {
            state.user = user;
            // window.localStorage.setItem('userID', JSON.stringify(user.id));
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
        },
        // ADD_ELEMENT(state, element, array) {
        //     state[array].push(element);
        // },
        SET_PRODUCT_PROPERTY_LIST(state, [productsArray, listArray, firstLevelProperty, secondLevelProperty]) {
            state[productsArray].forEach(product => {
                if(firstLevelProperty === undefined) {
                    return;
                }else if (Array.isArray(product[firstLevelProperty])) {
                    product[firstLevelProperty].forEach(element => {
                        if(!state[listArray].includes(element[secondLevelProperty])) {
                            state[listArray].push(element[secondLevelProperty]);
                        }
                    });
                }else if (secondLevelProperty === undefined) {
                    if (!state[listArray].includes(product[firstLevelProperty])){
                        state[listArray].push(product[firstLevelProperty]);
                    }
                } else if (!state[listArray].includes(product[firstLevelProperty][secondLevelProperty])) {
                    state[listArray].push(product[firstLevelProperty][secondLevelProperty]);
                }
            });
        }
    },
    actions: {
        getSetUser({ commit }) {
            return axios.get('/api/user')
            .then(res => {
                    commit('SET_USER', res.data );                        
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
        getSetProducts({ commit }, query = '') {
            console.log(`/api/products${query}`);
            return axios.get(`/api/products${query}`)
            .then(
                res => {
                    commit('SET_PRODUCTS', res.data );
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
        setPropertiesLists({ commit }) {
            commit('SET_PRODUCT_PROPERTY_LIST', ['allProducts', 'animeList', 'anime', 'name']);
            commit('SET_PRODUCT_PROPERTY_LIST', ['allProducts', 'categoriesList', 'categories', 'name']);
            commit('SET_PRODUCT_PROPERTY_LIST', ['allProducts', 'colorsList', 'color']);
            commit('SET_PRODUCT_PROPERTY_LIST', ['allProducts', 'seasonsList', 'season', 'name']);
            commit('SET_PRODUCT_PROPERTY_LIST', ['allProducts', 'sizesList', 'variants', 'size']);
        },
        handleLogout({ commit }) {
            axios.post('/logout')
                .then(() => {
                    commit('SET_USER', null);
                    window.localStorage.removeItem('user');
                })
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
    },
    // getters: {
    //     updatedProducts: state => {
    //         return state.allProducts;
    //     }
    // }
})
