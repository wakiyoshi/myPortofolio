<template>
    <v-app>
        <admin-header-component/>
        <v-main>
            <div id="container">
                <h2>お問い合わせ管理</h2>
                <tr v-for="(message,index) in messages" :key="index">
                    <td>
                        <p style="color: red;">{{message.user_message}}</p>
                        <p>{{message.admin_message}}</p>
                        <p>{{message.created_at}}</p>

                    </td>
                </tr>
                <form @submit.prevent="sendMessage">
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
                @click="sendMessage"
                :disabled="activateSubmit()">
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
            }
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
