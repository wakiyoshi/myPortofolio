
 export default {
    user:{
        name: null,
        auth : null,
        token: null,
    },

    mutations: {
        setUser(user,payload){
            user.name = payload.name
            user.email = payload.email
            user.token = payload.token
        },
    },
    actions: {
        setUsers(context,user){
            context.commit("setUser", user)
        }
    }

}






