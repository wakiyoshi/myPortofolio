<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <v-main>
            <div id="container">
                <div class="current-page">
                    <v-btn
                        dark
                        color="grey">情報入力</v-btn>
                        <p>>>></p>
                        <v-btn
                        dark
                        color="black ">情報確認</v-btn>
                        <p>>>></p>
                        <v-btn
                        dark
                        color="grey">注文完了
                    </v-btn>
                </div>
                <div class="confirmation">
                    <p>決済金額</p><h3>{{this.$route.query.payment}}</h3>
                    <p>氏名</p><h3>{{ this.$route.query.name}}</h3>
                    <p>氏名カナ</p><h3>{{ this.$route.query.kana}}</h3>
                    <p>メールアドレス</p><h3>{{ this.$route.query.email}}</h3>
                    <p>お届け先住所</p><h3>{{ this.$route.query.address}}</h3>
                    <p>電話番号</p><h3>{{ this.$route.query.phone}}</h3>
                    <p>お支払い方法</p>
                    <p>クレジットカード番号</p><h3>{{ this.$route.query.cardNumber}}</h3>
                    <p>有効期限</p><h3>{{ this.$route.query.expiration}}</h3>
                    <p>カード名義</p><h3>{{ this.$route.query.cardName}}</h3>
                    <p>cvc</p><h3>{{ this.$route.query.cvc}}</h3>
                    <v-btn
                    dark
                    color="black"
                    @click="confirm"
                    >注文を確定する</v-btn>
                <router-link :to="{ name:'payment-information',params: { payment: this.$route.query.payment}}" >
                    <v-btn
                    dark
                    color="black ">注文内容を編集する</v-btn>
                </router-link>
                </div>

            </div>

        </v-main>
    </v-app>

</template>

<script>
    export default {

        data(){
            return{

            }
        },
        methods:{
            confirm(){
            axios.post('api/payment/confirm',this.$route.query)
            .then(response => {
                console.log(response.data)
                this.$router.push('/payment-complete')
            })
            .catch(error=>{
                console.log(error)
            });
            }



        },
        mounted(){

        },


    }
</script>

<style scoped>
#container{
    text-align: center;

}
.information-form{
    align-items: center;

}

#product-list {
    display: flex;
    flex-wrap: wrap;
}
</style>
