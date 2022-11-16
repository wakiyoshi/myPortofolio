<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <v-container fluid align="center" justify="center">
            <v-row class="mt-6 hidden-sm-and-down" align="center" justify="center" >
                <v-btn
                    class="px-10 py-6 mr-4 white--text"
                    color="grey"><h2>情報入力</h2></v-btn>
                <h2 class="arrow-signs">>>></h2>
                <v-btn
                class="px-10 py-6 mr-4 ml-4 white--text"
                color="black"><h2>情報確認</h2></v-btn>
                <h2 class="arrow-signs">>>></h2>
                <v-btn
                class="px-10 py-6 mr-4 ml-4 white--text"
                color="grey"><h2>注文完了</h2></v-btn>
            </v-row>
            <v-row class="mt-10" align="center" justify="center">
                <h2>
                    入力した情報を確認し、情報を送信してください
                </h2>
            </v-row>
            <v-row class="mt-6 " align="center" justify="center" >
            <v-divider width="60%"></v-divider>
            </v-row>
            <v-row  class="mt-10 mb-16">
                <v-col lg="3" md="3" sm="2" cols="2">
                    <v-spacer></v-spacer>
                </v-col>
                <v-col lg="6" md="6" sm="8" cols="8"  class="user-information" align="center" justify="center">
                    <p class="mt-6">決済金額</p>
                    <h3>{{this.$route.query.payment}}円</h3>

                    <p class="mt-4">氏名</p><h3>{{ this.$route.query.name}}</h3>

                    <p class="mt-4">氏名カナ</p><h3>{{ this.$route.query.kana}}</h3>
                    <p class="mt-4">メールアドレス</p><h3>{{ this.$route.query.email}}</h3>
                    <p class="mt-4">お届け先住所</p><h3>{{ this.$route.query.address}}</h3>
                    <p class="mt-4">電話番号</p><h3>{{ this.$route.query.phone}}</h3>
                    <p class="mt-4">お支払い方法</p><h3>{{ this.$route.query.cardNumber}}</h3>
                    <p class="mt-4">有効期限</p><h3>{{ this.$route.query.expiration}}</h3>
                    <p class="mt-4">カード名義</p><h3>{{ this.$route.query.cardName}}</h3>
                    <p class="mt-4">cvc</p><h3>{{ this.$route.query.cvc}}</h3>
                <v-divider class="mt-6" width="80%"></v-divider>
                <v-col class="mt-4">
                    <v-btn
                        color="orange accent-1"
                        class="py-6 px-16 font-weight-bold black--text"
                        @click="confirm()"
                        ><h3>注文を確定する</h3>
                    </v-btn>
                </v-col>
                <v-col class="mb-4">
                <router-link :to="{ name:'payment-information',
                query: {
                    payment: this.$route.query.payment,
                    users:{
                        name: this.$route.query.payment,
                        kana: this.$route.query.kana,
                        email: this.$route.query.email,
                        address: this.$route.query.address,
                        phone: this.$route.query.phone,
                        cardNumber: this.$route.query.cardNumber,
                        expiration: this.$route.query.expiration,
                        cardName: this.$route.query.cardName,
                        cvc: this.$route.query.cvc,
                    }
                }}" >
                <v-btn
                class="py-3 px-10 font-weight-bold white--text"
                color="black ">
                注文内容を編集する
                </v-btn>
                    </router-link>
                </v-col>
                </v-col>

            </v-row>
        </v-container>
        <footer-component/>
    </v-app>


</template>

<script>
    export default {

        data(){
            return{
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
            confirm(){
            axios.post('api/payment/confirm',this.$route.query)
            .then(response => {
                console.log(response.data)
                this.$router.push('/payment-complete')
            })
            .catch(error=>{
                console.log(error)
            });
            },
        },
        mounted(){
            this.checkLogin()
        },
    }
</script>

<style scoped>


.arrow-signs{
    color: lightgray;
}
p{
    white-space: nowrap;
}
.user-information{
    background-color: #EEEEEE;
    border-radius: 20px;

}
a:link, a:visited, a:hover, a:active{
    color:black;
    text-decoration: none;
}
</style>
