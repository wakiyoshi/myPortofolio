<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>

        <v-container fluid>
            <v-row align="center" justify="center">
                <h2 class="mt-16 mb-12">お問い合わせ</h2>
            </v-row>
            <v-row v-for="(message,index) in messages" :key="index" >
                <v-col v-if="message.admin_message" align="center" justify="center">
                    <v-row>
                        <v-col lg="2" md="2" sm="2" cols="3">
                            <v-spacer ></v-spacer>
                        </v-col>
                        <v-col lg="4" md="4" sm="4" cols="6" >
                            <h4 >Interigent 管理者</h4>
                            <v-alert class="user-message "
                            elevation="6"
                            color="orange lighten-4 " >
                            {{message.admin_message}}
                            </v-alert>
                            <h5>{{message.created_at| moment}}</h5>

                        </v-col>
                        <v-col lg="6" md="6" sm="6" cols="3">
                            <v-spacer ></v-spacer>
                        </v-col>
                    </v-row>

                </v-col>
                <v-col v-if="message.user_message" align="center" justify="center">
                    <v-row>
                        <v-col lg="6" md="6" sm="6" cols="3">
                            <v-spacer ></v-spacer>
                        </v-col>
                        <v-col lg="4" md="4" sm="4" cols="6" align="center" justify="center">
                            <v-alert class="admin-message"
                            elevation="6"
                            color="grey lighten-2">
                            {{message.user_message}}
                            </v-alert>
                        <h5>{{message.created_at| moment}}</h5>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
               <form @submit.prevent="messageCreate">
                <v-row v-if="messages" align="center" justify="center">
                    <v-col lg="6" md="6" sm="8" cols="8">
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
                <v-row v-if="messages"  align="center" justify="center">
                    <v-btn
                    class="py-3 px-8 font-weight-bold white--text"
                    color="black"
                    @click="messageCreate"
                    :disabled="activateSubmit">
                    送信</v-btn>
                </v-row>
                </form>
                <v-row v-if="messages" class="mt-10 mb-16" align="center" justify="center">
                    <v-btn
                    @click="$router.back()"
                    class="py-3 px-15 font-weight-bold"
                    dark
                    color="black">
                    前のページに戻る</v-btn>
                </v-row>
            </v-container>
        <footer-component/>
    </v-app>


</template>

<script>
import moment from 'moment'

export default {
    data(){
        return{
            messages: [],
            messageContent:{
                text: '',
            },
            isLoggedin: null,
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
                    this.$router.push('/login')
                }
        },
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
                this.messageContent.text = null
                this.messageIndex()
            })
            .catch(error =>{
                console.log(error);
            });
        },

        scrollToBottom(){
            const elm = document.documentElement;
            const bottom = elm.scrollHeight - elm.clientHeight;
            window.scroll(0, bottom-400);
        }
    },
        computed:{
            activateSubmit(){
                if(this.messageContent.text === ''){
                    return true;
                }else{
                    return false;
                }
        },
        },
        mounted(){
            this.checkLogin()
            this.messageIndex()

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
</style>
