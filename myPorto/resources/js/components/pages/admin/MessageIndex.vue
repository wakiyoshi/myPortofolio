<template>
    <v-app>
        <admin-header-component/>
        <v-main>
            <div id="container">
                <h2>お問い合わせ管理</h2>
                <tr v-for="(message,index) in messages" :key="index">
                    <td>
                        <div >{{message.name}}</div>
                        <div v-bind="text">{{message.user_message}}</div>
                        <router-link :to="{ name:'admin-message',params:{id: message.user_id}}">
                            <v-btn
                            class="py-3 px-15 font-weight-bold"
                            dark
                            color="black">
                            トークルーム</v-btn>
                        </router-link>
                    </td>
               </tr>
            </div>
        </v-main>
    </v-app>

</template>

<script>


    export default {

        data(){
            return{
                messages: null,
                text: null,
                isLoggedin: null,
            }
        },
        methods:{
            checkLogin(){
                if(this.$store.getters['adminAuth/setAdminToken']){
                    this.isLoggedin = true
                }else{
                    this.isLoggedin = false
                    this.$router.push("/admin-login")
                }
                },
        },
        mounted(){
            this.checkLogin();
            axios.get('/api/admin/message',{
                headers: {
                    Authorization: `Bearer ${this.$store.getters['adminAuth/setAdminToken']}`,
                }
                }
            )
            .then(response => {
                console.log(response.data)
                this.messages = response.data;

            })
            .catch(error=>{
                console.log(error)
            });
        },

    }
</script>

<style scoped>

a{
    text-decoration: none;
}
</style>
