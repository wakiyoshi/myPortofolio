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
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/1zWqT5EB67a0rVnUAlg4jpSSyLaCeTkD0TaWi1Ow.png"
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
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/0d9XYtlZ7tw2QYmX410MYPQkfyUmVlsOg1622Kc9.png"
                                width="94%"
                                height="70%"
                                max-height="40vw">
                                </v-img>
                            </router-link>
                            <v-col>
                                <h3>New line up</h3>
                                <h4 class="mt-2">季節に合う商品が新登場。
                                </h4>
                            </v-col>
                        </v-col>
                        <v-col lg="4" md="4" sm="6" cols="12" align="center" justify="center">
                            <router-link to="/plp">
                                <v-img
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/67S2zCprKC5mRwBp5vjnfqWYOM6JVPpsibL52R1w.png"
                                width="92%"
                                height="70%"
                                max-height="40vw"
                                >
                                </v-img>
                            </router-link>
                            <v-col>
                                <h3>New line up</h3>
                                <h4 class="mt-2">季節に合う商品が新登場。
                                </h4>
                            </v-col>
                        </v-col>
                        <v-col lg="4" md="4" sm="12" cols="12" align="center" justify="center">
                            <router-link to="/plp" >
                                <v-img
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/ukphphLPgbuCX3EEsWd5LtnGcceNLXs5qCfWcseW.png"
                                width="100%"
                                height="100%"
                                max-height="40vw">
                                </v-img>
                            </router-link>
                        <v-col >
                            <h3>dishes</h3>
                            <h4 class="mt-2">
                                美しい食器で、料理に一層の彩を。
                            </h4>
                        </v-col>


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
