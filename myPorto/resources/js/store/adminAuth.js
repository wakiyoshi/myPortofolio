import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)


const getters = {

    setAdminToken(state){
        return state.admin.token
    }
}

const state = {

    admin:{
        name: null,
        auth: null,
        token: null
    }
}

const mutations = {

    setAdmin(state,payload){
        state.admin.name = payload.name
        state.admin.auth = payload.auth
        state.admin.token = payload.token
    },

}

const actions = {

    setAdmins(context,admin){
        context.commit("setAdmin", admin)
    }
}

export default {
  namespaced: true,
  getters,
  state,
  mutations,
  actions,
}






