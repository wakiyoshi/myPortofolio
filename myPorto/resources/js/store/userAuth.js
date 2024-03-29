import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)


const getters = {
    setToken(state){
        return state.user.token;
    },

}

const state = {
    user:{
        name: null,
        auth : null,
        token: null,
    },

}

const mutations = {
    setUser(state,payload){
        state.user.name = payload.name
        state.user.auth = payload.auth
        state.user.token = payload.token
    },

}

const actions = {
    setUsers(context,user){
        context.commit("setUser", user)
    },
}

export default {
  namespaced: true,
  getters,
  state,
  mutations,
  actions,
}






