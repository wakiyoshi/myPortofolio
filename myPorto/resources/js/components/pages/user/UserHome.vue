<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <menu-component/>
            <h1>UserHome</h1>
            <p>ログイン{{ user.email }}</p>
            <p>{{ user.name }}</p>
            <div id="container">
                <div id="top-banner">
                    <router-link to="/">
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
            }
        },
        mounted(){
            axios.get('/api/user')
            .then(response => {
                if (response.status = 200){
                    this.user = response.data;
                }
                else{
                    this.$router.push("/login")
                }
            })
            .catch(error=>{
                this.$router.push("/login")
            });
            },
            methods:{
                logout(){
                    axios.post('/logout')
                    .then(response => {
                        console.log(response);
                        this.$router.push("/login");
                    })
                    .catch(error =>{
                        console.log(error);
                    });
                }

            }

    }
</script>

<style scoped>
#sub-contents{
    display: flex;
}
</style>
