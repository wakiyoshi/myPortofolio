<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>

        <v-main>
            <div id="container">
                <h2>お問い合わせ</h2>
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
            <div>
                <v-btn
                class="py-3 px-8 font-weight-bold white--text"
                color="black"
                @click="messageCreate"
                :disabled="activateSubmit">
                送信</v-btn>
            </div>
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
            window.scroll(0, bottom);
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
        }


}
</script>

<style scoped>
a{
    text-decoration: none;
}
</style>
