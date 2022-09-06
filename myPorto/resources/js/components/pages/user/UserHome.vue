<template>
    <v-app>

        <campaign-component/>
        <user-header-component/>
        <menu-component/>
        <Breadcrumbs />
            <div>{{this.$route.referrer}}</div>
            <h1>UserHome</h1>
            <p>ログイン{{ user.email }}</p>
            <p>{{ user.name }}</p>
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
                token: null
            }
        },
        methods:{
            userInfo() {
                axios.get('/api/user/auth',
                {
                headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then ((res) => {
                console.log(res)
                if( !this.$store.getters['userAuth/setToken'])

                {
                    this.$router.push("/login")
                }
                })
                .catch((err) => {
                    console.log(err)
                    this.$router.push("/login")
                })
                },
            logout(){
                this.$store.dispatch('userAuth/setUsers', {name: null ,auth:false ,token: null})
                this.$router.push("/login",()=>{})


            },
        },

        mounted(){
            this.userInfo();

        },
    }
</script>

<style scoped>
#sub-contents{
    display: flex;
}
</style>
