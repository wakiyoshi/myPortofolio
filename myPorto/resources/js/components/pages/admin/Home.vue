<template>
    <v-app>
        <admin-header-component/>
        <v-main>
            <div id="container">
                <h1>管理者TOPページ</h1>

                <router-link to="/admin-message-index">
                    <v-btn>
                        お問い合わせ管理
                    </v-btn>
                </router-link>
                <router-link to="/admin-product-index">
                    <v-btn>
                        商品管理
                    </v-btn>
                </router-link>
                    <v-btn
                    @click="logout"
                    color="blue">
                        ログアウト
                    </v-btn>
            </div>
        </v-main>
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

#product-list {
    display: flex;
    flex-wrap: wrap;
}

</style>

