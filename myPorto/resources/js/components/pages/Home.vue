<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component class="hidden-sm-and-down"/>
            <v-container fluid>

                    <v-row class="top-banner" >
                        <v-col lg='12' md='12' sm="12" cols="12" >
                            <router-link to="/plp">
                                <v-img
                                src="/img/top_banner.png"
                                :height="height"
                                width="100%"
                                >
                                </v-img>
                            </router-link>
                        </v-col>
                    </v-row>
                    <v-row align="center" justify="center" >
                        <v-col lg="4" md="4" sm="6" cols="12"  align="center" justify="center">
                            <router-link to="/plp">
                                <v-img
                                src="/img/top_image3.png"
                                width="98%"
                                height="80%"
                                max-height="40vw">
                                </v-img>
                            </router-link>
                            <h3>New line up</h3>
                            <p>季節に合う商品が新登場。
                                お部屋をカスタマイズしましょう。
                            </p>
                        </v-col>
                        <v-col lg="4" md="4" sm="6" cols="12" align="center" justify="center">
                            <router-link to="/plp">
                                <v-img
                                src="/img/top_image3.png"

                                width="98%"
                                height="90%"
                                max-height="40vw"
                                >
                                </v-img>
                            </router-link>
                            <h3>New line up</h3>
                            <p>季節に合う商品が新登場。
                                お部屋をカスタマイズしましょう。
                            </p>
                        </v-col>
                        <v-col lg="4" md="4" sm="12" cols="12" align="center" justify="center">
                            <router-link to="/plp" >
                                <v-img
                                src="/img/top_image3.png"
                                width="98%"
                                height="80%"
                                max-height="40vw">
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
        computed:{
        height () {
            switch (this.$vuetify.breakpoint.name) {
            case 'xs': return "100%"
            case 'sm': return "100%"
            case 'md': return "100%"
            case 'lg': return "100%"
            case 'xl': return "100%"
            }
        }
        }

    }
</script>

<style scoped>


</style>
