<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
            <v-container fluid>
                <Breadcrumbs class="breadcrumbs" width="50"/>
                    <v-row class="top-banner" align-content="center">
                        <v-col lg='12' md='12' sm="12" align="center">
                            <router-link to="/plp">
                                <v-img
                                src="/img/top_banner.png"
                                max-width="95%"
                                width="95%"

                                >
                                </v-img>
                            </router-link>
                        </v-col>
                    </v-row>
                    <v-row justify="center" >
                        <v-col md="4" sm="4" class="pl-14 " align="center">
                            <router-link to="/plp">
                                <v-img
                                src="/img/top_image1.png"
                                width="100%"
                                height="80%">
                                </v-img>
                            </router-link>
                            <h3>New line up</h3>
                            <p>季節に合う商品が新登場。
                                お部屋をカスタマイズしましょう。
                            </p>
                        </v-col>
                        <v-col md="4" sm="4" class="" align="center">
                            <router-link to="/plp">
                                <v-img
                                src="/img/top_image2.png"
                                width="100%"
                                height="80%"
                                >
                                </v-img>
                            </router-link>
                            <h3>New line up</h3>
                            <p>季節に合う商品が新登場。
                                お部屋をカスタマイズしましょう。
                            </p>
                        </v-col>
                        <v-col md="4" sm="4" align="center" class="pr-14">
                            <router-link to="/plp" >
                                <v-img
                                src="/img/top_image3.png"
                                width="100%"
                                height="80%">
                                </v-img>
                            </router-link>
                            <h3>New line up</h3>
                            <p>季節に合う商品が新登場。
                                お部屋をカスタマイズしましょう。
                            </p>
                        </v-col>
                    </v-row>
                <v-btn
                @click="logout" color="blue" width="100%">ログアウト
                </v-btn>
            </v-container>
        <footer-component/>
    </v-app>
</template>

<script>


    export default {
        data(){
            return{
                user: [],
                token: null,
            }
        },
        methods:{
            checkLogin(){
                if( this.$store.getters['userAuth/setToken'] ){
                    this.isLoggedin = true
                    console.log(sessionStorage.getItem('User'));
                }else if(!sessionStorage.getItem('User') && this.$store.getters['userAuth/setToken']){
                    this.isLoggedin = false
                    console.log(sessionStorage.getItem('User'));
                    this.$router.push('/login')
                }else{
                    this.isLoggedin = false
                    console.log(sessionStorage.getItem('User'));
                }
            },
            logout(){
                this.$store.dispatch('userAuth/setUsers', {name: null ,auth:false ,token: null})
                this.$router.push("/login",()=>{})
            },
        },
        created(){
            this.checkLogin();
        },
    }
</script>

<style scoped>
.breadcrumbs{
    width: 200px;
}

</style>
