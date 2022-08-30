import Vue from 'vue'
import Vuex from 'vuex'
import userAuth from './userAuth.js'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
      userAuth,
  }
})

export default store
