<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component class="hidden-sm-and-down"/>
            <v-container fluid>
                    <v-row>
                        <v-carousel
                        :show-arrows="false"
                        hide-delimiter-background
                        tile
                        height="80%"
                        align="center" justify="center">
                            <router-link to="/plp">
                                <v-carousel-item
                                    width="95%"
                                    
                                    v-for="(image,i) in images"
                                    :key="i"
                                    :src="image"
                                >
                                </v-carousel-item>
                            </router-link>
                        </v-carousel>
                    </v-row>


                    <v-row class="mt-8" align="center" justify="center" >
                        <v-col  lg="4" md="4" sm="4" cols="12"  align="center" justify="center">
                            <router-link to="/plp">
                                <v-img
                                class=""
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/oPXj612njPNaYuEWE5EYYXo4A66FMU1mhgWTYSKY.png"
                                width="90%"
                                height="70%"
                                max-height="40vw">
                                </v-img>
                            </router-link>
                        <h4 class="mt-4">Dishes</h4>
                        <p class="mt-2 subtitle-2">お洒落な食器で,食事をより楽しみに。</p>
                        </v-col>
                        <v-col lg="4" md="4" sm="4" cols="12" align="center" justify="center">
                            <router-link to="/plp">
                                <v-img
                                class=""
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/uwWp9jVvDAPqYnRufAT3waKq8H3fopNxEbAsnSpE.png"
                                width="90%"
                                height="70%"
                                max-height="40vw"
                                >
                                </v-img>
                            </router-link>
                        <h4 class="mt-4">Cooking</h4>
                        <p class="mt-2 subtitle-2">最新の調理器具、より便利に快適に。</p>
                        </v-col>
                        <v-col lg="4" md="4" sm="4" cols="12" align="center" justify="center">
                            <router-link to="/plp" >
                                <v-img
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/8xzceA0qTHtpCoydGPIv4JhdrDUcIZZpt7nddBQ6.png"
                                width="90%"
                                height="70%"
                                max-height="60vw">
                                </v-img>
                            </router-link>
                        <h4 class="mt-4">New line up</h4>
                        <p class="mt-2 subtitle-2">季節に合う商品でお部屋カスタマイズしましょう。</p>
                        </v-col>
                    </v-row>
                    <!-- <v-row class="top-banner" >
                        <v-col lg='12' md='12' sm="12" cols="12" align="center" justify="center">
                            <router-link to="/plp">
                                <v-img
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/1zWqT5EB67a0rVnUAlg4jpSSyLaCeTkD0TaWi1Ow.png"
                                height="65%"
                                width="98%"
                                >
                                </v-img>
                            </router-link>
                        </v-col>
                    </v-row> -->
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
                images:
                ['https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/Obc5dFcKPAlj23Mb0IXwlpKAlIpZzEp6GcQcvMGL.png',
                'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/ohgBmUXWa1mRW86rtxuBsvlgHBprspaT4DBDiaGW.jpg',
                'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/wPlSxlOiGTam88Er0Pa3wMhFHRjvA7xOv1zfPSAM.jpg'
                ],
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
        // height () {
        //     switch (this.$vuetify.breakpoint.name) {
        //     case 'xs': return "100%"
        //     case 'sm': return "100%"
        //     case 'md': return "100%"
        //     case 'lg': return "100%"
        //     case 'xl': return "100%"
        //     }
        // }
        }

    }
</script>

<style scoped>


</style>
