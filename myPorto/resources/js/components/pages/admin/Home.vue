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
                    @click="adminLogout"
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

            }
        },
        methods:{
            adminLogout(){
                axios.post('/admin/logout')
                .then(response => {
                    console.log(response);
                    this.$router.push("/admin-login");
                })
                .catch(error =>{
                    console.log(error);
                });
            }
        },
        mounted(){
            axios.get('api/admin/user')
            .then(response => {
                if (response.status === 200){
                   console.log(response);
                }
                else{
                    this.$router.push("/admin-login")
                }
            })
            .catch(error=>{
                this.$router.push("/admin-login")
            });

        },


    }
</script>

<style scoped>

#product-list {
    display: flex;
    flex-wrap: wrap;
}
</style>

