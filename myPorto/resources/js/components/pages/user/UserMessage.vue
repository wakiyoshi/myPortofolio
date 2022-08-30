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
                @click="sendMessage">
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
            messages: this.message,
            messageContent:{
                text: null,
            }
        }
    },
    methods:{
        sendMessage(){
            axios.post('/user/message/create', this.messageContent)
            .then(response => {
                console.log(response);
                this.$router.go({path: this.$router.currentRoute.path,force: true})
                this.messageContent.text = null
            })
            .catch(error =>{
                console.log(error);
            });
    }
    },
    mounted(){
        axios.get('api/user')
        .then(response => {
            if (response.status === 200){
            console.log(response);
            }
            else{
                this.$router.push("/login")
            }
        })
        .catch(error=>{
            this.$router.push("/login")
        });

        axios.get('/user/message')
        .then(response => {
            this.messages = response.data;
            console.log(response)
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
