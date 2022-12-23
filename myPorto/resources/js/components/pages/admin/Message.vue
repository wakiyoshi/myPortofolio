<template>
    <v-app>
        <admin-header-component/>
        <v-container fluid>
            <v-row v-if="users" class="mb-16" align="center" justify="center">
                <h3>{{ users.name}} 様のお問い合わせ</h3>
            </v-row>
            <v-row class="" v-for="(message,index) in messages" :key="index" >
                <v-col v-if="message.user_message" align="center" justify="center">
                    <v-row>

                        <v-col lg="2" md="2" sm="2" cols="2">
                            <v-spacer ></v-spacer>
                        </v-col>
                        <v-col lg="4" md="4" sm="4" cols="4" >
                            <h5 class="mb-2">{{ users.name}}様</h5>
                            <v-alert class="user-message "
                            elevation="6"
                            color="orange lighten-4 " >
                            <p class="subtitle-2">
                            {{message.user_message}}
                            </p>
                            </v-alert>
                                <h5>{{message.created_at| moment}}</h5>
                        </v-col>

                    </v-row>

                </v-col>
                <v-col v-if="message.admin_message" align="center" justify="center">
                    <v-row>
                        <v-col lg="6" md="6" sm="6" cols="6">
                            <v-spacer ></v-spacer>
                        </v-col>
                        <v-col lg="4" md="4" sm="4" cols="4" align="center" justify="center">
                            <v-alert class="admin-message"
                            elevation="6"
                            color="grey lighten-2">
                            {{message.admin_message}}
                            </v-alert>
                        <h5>{{message.created_at| moment}}</h5>
                        </v-col>

                    </v-row>
                </v-col>
            </v-row>
            <form @submit.prevent="sendMessage">
                <v-row v-if="messages" align="center" justify="center">
                    <v-col lg="6" md="6" sm="6" cols="6">
                        <v-textarea
                        filled
                        id="message-form"
                        dense
                        value="message"
                        v-model="messageContent.text"

                        :label="users.name + '様 メッセージを送信'"
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
            <v-row v-if="messages" class="mt-10 mb-16" align="center" justify="center">
                <router-link to= '/admin-message-index'>
                    <v-btn
                    class="py-3 px-15 font-weight-bold"
                    dark
                    color="black"
                    dense>
                    メッセージ一覧に戻る</v-btn>
                </router-link>
            </v-row>

        </v-container>
    </v-app>

</template>

<script>
import moment from 'moment'

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
            window.scroll(0, bottom-400);
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
        },
            filters: {
        moment: function (date) {
            return moment.utc(date,'YYYY/MM/DD HH:mm').local().format('YYYY/MM/DD HH:mm');
        }
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
