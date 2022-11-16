<template>
    <v-app>
        <admin-header-component/>
        <v-container fluid>
            <v-row v-if="users" class="mb-16" align="center" justify="center">
                <h2>{{ users.name}} 様のお問い合わせ</h2>
            </v-row>
            <v-row v-for="(message,index) in messages" :key="index" align="center" justify="center">
                <v-col align="center" justify="center">
                    <p class="user-message">{{message.user_message}}</p>


                    <p class="admin-message">{{message.admin_message}}</p>

                    <p>{{message.created_at}}</p>
                </v-col>
            </v-row>
            <form @submit.prevent="sendMessage">
                <v-row v-if="messages" align="center" justify="center">
                    <v-col lg="10" md="10" sm="8" cols="8">
                        <v-textarea
                        filled
                        id="message-form"
                        dense
                        value="message"
                        v-model="messageContent.text"

                        label="メッセージを入力"
                        ></v-textarea>
                    </v-col>
                </v-row>
                <v-row v-if="messages" align="center" justify="center">
                    <v-btn
                    class="py-3 px-8 font-weight-bold white--text"
                    color="black"
                    @click="sendMessage"
                    :disabled="activateSubmit()">
                    送信</v-btn>
                </v-row>
             </form>
            <v-row v-if="messages" class="mt-16 mb-16" align="center" justify="center">
                <router-link to= '/admin-message-index'>
                    <v-btn
                    class="py-3 px-15 font-weight-bold"
                    dark
                    color="black">
                    メッセージ一覧に戻る</v-btn>
                </router-link>
            </v-row>

        </v-container>
    </v-app>

</template>

<script>


export default {
    data(){
        return{
            messages: this.message,
            messageContent:{
                text: '',
                id: this.$route.params.id,
                isLoggedin: null,
            },
            users: "",

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
        sendMessage(){
            axios.post('/api/admin/message/create', this.messageContent)
            .then(response => {
                console.log(response.data);
                this.getMessage()
                this.messageContent.text = null


            })
            .catch(error =>{
                console.log(error);
            });
        },
        getMessage(){
            axios.get('/api/admin/message/'+ this.$route.params.id,{
                headers: {
                    Authorization: `Bearer ${this.$store.getters['adminAuth/setAdminToken']}`,
                }
            }
            )
            .then(response => {
                this.messages = response.data;
                console.log(response)
            })
            .catch(error=>{
                console.log(error)
            });
        },
        getUser(){
            axios.get('/api/admin/message/user/'+ this.$route.params.id,{
                headers: {
                    Authorization: `Bearer ${this.$store.getters['adminAuth/setAdminToken']}`,
                }
            }
            )
            .then(response => {
                this.users = response.data;
                console.log(response)
            })
            .catch(error=>{
                console.log(error)
            });
        },
        activateSubmit(){
            if(this.messageContent.text === ''){
                return true;
            }else{
                return false;
            }
        },
        scrollToBottom(){
            const elm = document.documentElement;
            const bottom = elm.scrollHeight - elm.clientHeight;
            window.scroll(0, bottom);
            console.log("scroll");
        }
    },
        mounted(){
            this.checkLogin()
            this.getMessage()
            this.getUser()
        },
        updated(){
            this.scrollToBottom()
        }

}
</script>

<style scoped>
a{
    text-decoration: none;
}
input:disabled{
    background-color: gray;
}


</style>
