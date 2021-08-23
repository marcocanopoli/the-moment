import Vue from 'vue';
import Vuex from 'vuex';
import 'es6-promise/auto';
Vue.use(Vuex);

export const store = new Vuex.Store ({
    state: {
      user: null
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
      // }

    },
    actions: {
      setUser({ commit }) {
        axios.get('http://127.0.0.1:8000/api/user')
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
      }      
    }
  })
