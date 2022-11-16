<template>
    <v-app>
        <admin-header-component/>
        <v-container fluid>
            <v-row >
                <v-col align="center" justify="center" >
                    <h1>管理者TOPページ</h1>
                    <v-row align="center" justify="center">
                        <router-link to="/admin-message-index">
                            <v-btn color="black" class="mt-16 py-3 px-15 font-weight-bold white--text" width="200px">
                                お問い合わせ管理
                            </v-btn>
                        </router-link>
                    </v-row>
                    <v-row align="center" justify="center">
                    <router-link to="/admin-product-index">
                        <v-btn color="black" class="mt-10 py-2 px-15 font-weight-bold white--text"
                        width="200px">
                            商品管理
                        </v-btn>
                    </router-link>
                    </v-row >
                    <v-row align="center" justify="center">
                        <v-btn
                        color="black"
                        class="mt-10 py-3 px-15 font-weight-bold white--text"
                        @click="logout"
                        width="200px"
                        >
                            ログアウト
                        </v-btn>
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
    </v-app>

</template>

<script>


export default {

    data(){
        return{
            isLoggedin: null,
        }
    },
    methods:{
        checkLogin(){
            if( this.$store.getters['adminAuth/setAdminToken'] ){
                this.isLoggedin = true
                console.log(this.$store.getters['adminAuth/setAdminToken']);
            }else{
                this.isLoggedin = false
                console.log('not logged in');
                this.$router.push("/admin-login")
            }
            },
        logout(){
            this.$store.dispatch('adminAuth/setAdmins', {name: null ,auth:false ,token: null})
            this.$router.push("/admin-login",()=>{})
        }
        },
        mounted(){
            this.checkLogin();
        },


}
</script>

<style scoped>

a:link, a:visited, a:hover, a:active{
    color:black;
    text-decoration: none;
}


</style>

