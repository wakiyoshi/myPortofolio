<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <v-main>
            <div id="container">
                <div class="current-page">
                    <v-btn
                        dark
                        color="black">情報入力</v-btn>
                    <p>>>></p>
                    <v-btn
                    dark
                    color="grey">情報確認</v-btn>
                    <p>>>></p>
                    <v-btn
                    dark
                    color="grey">注文完了</v-btn>
                </div>
                <div class="information-form">
                    <h1>ご注文内容確認の上決済情報を入力してください</h1>
                    <v-divider></v-divider>
                    <p>決済金額:  </p>
                    <v-divider></v-divider>
                    <form @submit.prevent="sendInformation">

                        <v-row>
                            <span v-if="errors.name">
                                {{ errors.name[0] }}
                            </span>
                            <label class="name-label" for="name-form" >氏名</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="name-form"
                                dense
                                v-model="name"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <label class="kana-label" for="kana-form" >氏名カナ</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="kana-form"
                                dense
                                v-model="kana"
                                outlined
                                clearable
                                ></v-text-field>

                            </v-col>
                        </v-row>
                        <v-row>
                            <label class="email-label" for="email-form" >メールアドレス</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="email-form"
                                dense
                                v-model="email"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <label class="address-label" for="address-form" >お届け先住所</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="address-form"
                                dense
                                v-model="address"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <label class="phone-label" for="phone-form" >電話番号</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="phone-form"
                                dense
                                v-model="phone"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>

                        </v-row>
                        <v-row>
                            <p>お支払い方法</p>
                            <p>クレジットカード</p>
                            <v-img
                            src="/img/credit_card_brand.png"
                            max-width="400">
                            </v-img>
                        </v-row>
                        <v-row>
                            <label class="card-number-label" for="card-number-form" >カード番号</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="card-number-form"
                                dense
                                v-model="cardNumber"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <label class="expiration-label" for="expiration-form" >有効期限</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="expiration-form"
                                dense
                                v-model="expiration"
                                outlined
                                clearable
                                ></v-text-field>

                            </v-col>
                        </v-row>
                        <v-row>
                            <label class="card-name-label" for="name-form" >メールアドレス</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="card-name-form"
                                dense
                                v-model="cardName"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <label class="cvc-label" for="cvc-form" >パスワード</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="cvc-form"
                                dense
                                v-model="cvc"
                                outlined
                                clearable
                                ></v-text-field>

                            </v-col>

                        </v-row>

                            <div class="sendButton" >
                                <v-btn
                                class="py-3 px-15 font-weight-bold"
                                dark
                                color="black"
                                @click="sendInformation">
                                確認に進む</v-btn>
                            </div>

                        </form>
                </div>
            </div>
        </v-main>
    </v-app>

</template>

<script>
    export default {

        data(){
            return{
                name: null,
                kana: null,
                email: null,
                address: null,
                phone: null,
                cardNumber: null,
                expiration: null,
                cardName: null,
                cvc: null,
                errors:[],
            }
        },
        methods:{
                sendInformation(){
                this.$router.push({name:"payment-confirmation",query:{
                    name:this.name,
                    kana:this.kana,
                    email:this.email,
                    address: this.address,
                    phone: this.phone,
                    cardNumber: this.cardNumber,
                    expiration: this.expiration,
                    cardName: this.cardName,
                    cvc: this.cvc,
                    }})
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
