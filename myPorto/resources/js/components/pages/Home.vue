<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
        <Breadcrumbs />
            <div id="container">
                <div id="top-banner">
                    <router-link to="/plp">
                        <v-img
                        src="/img/top_banner.png"
                        max-width="80%">
                        </v-img>
                    </router-link>
                </div>
                <div id="sub-contents">
                    <div>
                        <router-link to="/">
                            <v-img
                            src="/img/top_image1.png"
                            max-width="80%">
                            </v-img>
                        </router-link>
                        <h3>New line up</h3>
                        <p>季節に合う商品が新登場。
                            お部屋をカスタマイズしましょう。
                        </p>
                    </div>
                    <div>
                        <router-link to="/">
                            <v-img
                            src="/img/top_image2.png"
                            max-width="80%">
                            </v-img>
                        </router-link>
                        <h3>New line up</h3>
                        <p>季節に合う商品が新登場。
                            お部屋をカスタマイズしましょう。
                        </p>
                    </div>
                    <div>
                        <router-link to="/">
                            <v-img
                            src="/img/top_image3.png"
                            max-width="80%">
                            </v-img>
                        </router-link>
                        <h3>New line up</h3>
                        <p>季節に合う商品が新登場。
                            お部屋をカスタマイズしましょう。
                        </p>
                    </div>
                </div>
            </div>
            <v-btn
            @click="logout" color="blue">ログアウト</v-btn>
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
#sub-contents{
    display: flex;
}
</style>
