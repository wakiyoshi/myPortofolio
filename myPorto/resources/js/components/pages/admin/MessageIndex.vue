<template>
    <v-app>
        <admin-header-component/>
        <v-container >
                <v-row class="mb-16" align="center" justify="center" >
                    <h3>お問い合わせ管理</h3>
                </v-row>
                <v-row class="message-content" align="center" justify="center"
                v-for="(message,index) in messages" :key="index" >
                    <v-col lg="1" md="1" sm="1" cols="1">
                        <v-spacer></v-spacer>
                    </v-col>
                    <v-col lg="2" md="2" sm="2" cols="2">
                        <h5>{{ message.name }} 様</h5>
                    </v-col>
                    <v-col class="" lg="3" md="2" sm="2" cols="2">
                        <h5>{{message.created_at| moment}}</h5>
                    </v-col>
                    <v-col class="" lg="3" md="3" sm="3" cols="3">
                        <h5 v-bind="text">{{message.user_message}}</h5>
                    </v-col>

                    <v-col class="">
                        <router-link :to="{ name:'admin-message',params:{id: message.user_id}}">
                            <v-btn
                            class="py-3 px-10 font-weight-bold"
                            dark
                            color="black">
                            <h5>トークルーム</h5>
                            </v-btn>
                        </router-link>
                    </v-col>


                </v-row>
                <!-- <v-row v-if="messages.length === 0 " align="center" justify="center">
                        <h3>お問い合わせはありません</h3>
                </v-row> -->

        </v-container>
    </v-app>

</template>

<script>

import moment from 'moment'


    export default {
        data(){
            return{
                messages: [],
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
            filters: {
        moment: function (date) {
            return moment.utc(date,'YYYY/MM/DD HH:mm').local().format('YYYY/MM/DD HH:mm');
        }
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

p{
    font-weight: bold;
}
.message-content{
    border-bottom: solid;
    border-width: 1px;
    border-color: lightgray;



}
</style>
