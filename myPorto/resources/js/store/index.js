import Vue from 'vue'
import Vuex from 'vuex'
import userAuth from './userAuth.js'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
      userAuth,
  },
  strict: true,
  plugins: [createPersistedState(
    {
        key: 'Interigent',
        paths: [
          'userAuth.user.token'
        ],
        storage: window.sessionStorage
    }
)],

})


export default store
