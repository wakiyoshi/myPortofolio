import Vue from 'vue'
import Vuex from 'vuex'
import userAuth from './userAuth.js'
import adminAuth from './adminAuth.js'

import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
      userAuth,
      adminAuth,
  },
  strict: true,
  plugins: [createPersistedState(
    {
        key: 'User',
        paths: [
          'userAuth.user.token'
        ],
        storage: window.sessionStorage
    },


),
  createPersistedState(
    {
        key: 'Admin',
        paths: [
          'adminAuth.admin.token'
        ],
        storage: window.sessionStorage
    },
),
],


})

export default store
