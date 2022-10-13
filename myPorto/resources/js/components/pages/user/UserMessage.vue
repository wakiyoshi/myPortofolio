<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <menu-component/>

        <v-main>
            <div id="container">
                <h2>お問い合わせ管理</h2>
                <tr v-for="(message,index) in messages" :key="index">
                    <td>
                        <p>{{message.user_message}}</p>
                        <p style="color:red;">{{message.admin_message}}</p>
                        <p>{{message.created_at}}</p>

                    </td>
               </tr>
               <form @submit.prevent="messageCreate">
                <v-text-field
                id="message-form"
                dense
                v-model="messageContent.text"
                outlined
                ></v-text-field>

                <v-btn
                class="py-3 px-8 font-weight-bold"
                dark
                color="black"
                @click="messageCreate">
                送信</v-btn>
                </form>

            <router-link to= '/admin-message-index'>
                <v-btn
                class="py-3 px-15 font-weight-bold"
                dark
                color="black">
                メッセージ一覧に戻る</v-btn>
            </router-link>
            </div>
        </v-main>
         <footer-component/>
    </v-app>


</template>

<script>


export default {
    data(){
        return{
            messages: [],
            messageContent:{
                text: null,
            }
        }
    },
    methods:{
        messageIndex(){
            axios.get('/api/message/',
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(response => {
                    this.messages = response.data;
                    console.log(response.data)
                })
                .catch(error=>{
                    console.log(error)
                });
        },
        messageCreate(){
            axios.post('api/message/', this.messageContent,                {
                headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
            .then(response => {
                console.log(response.data);

                // this.$router.go({path: this.$router.currentRoute.path,force: true})
                this.messageContent.text = null

                this.messageIndex()

            })
            .catch(error =>{
                console.log(error);
            });
        },
        checkLogin(){
            if( this.$store.getters['userAuth/setToken']){
                this.isLoggedin = true
            }else{
                this.isLoggedin = false
                this.$router.push('/login')
            }
        },
    },
        mounted(){
            this.checkLogin()
            this.messageIndex()
            },
}
</script>

<style scoped>
a{
    text-decoration: none;
}
</style>
