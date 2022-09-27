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
                    <p v-if="users.payment">決済金額: {{ users.payment }} 円</p>
                    <v-divider></v-divider>

                    <form @submit.prevent="sendInformation">
                        <div v-if="users.name">
                        <p v-if="isInValidName" class="error">名前は２文字以上で入力してください</p>
                        </div>
                        <v-row>
                            <label class="name-label" for="name-form" >氏名</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="name-form"
                                dense
                                v-model="users.name"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <div v-if="users.kana">
                        <p v-if="isInValidKana" class="error">カナは２文字以上で入力してください</p>
                        </div>
                        <v-row>
                            <label class="kana-label" for="kana-form" >氏名カナ</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="kana-form"
                                dense
                                v-model="users.kana"
                                outlined
                                clearable
                                ></v-text-field>

                            </v-col>
                        </v-row>
                        <div v-if="users.email">
                        <p v-if="isInvalidEmail" class="error">有効なメールアドレスを入力してください</p>
                        </div>
                        <v-row>
                            <label class="email-label" for="email-form" >メールアドレス</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="email-form"
                                dense
                                v-model="users.email"
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
                                v-model="users.address"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <div v-if="users.phone">
                        <p v-if="isInValidPhone" class="error">有効な電話番号を入力してください。</p>
                        </div>
                        <v-row>
                            <label class="phone-label" for="phone-form" >電話番号</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="phone-form"
                                dense
                                v-model="users.phone"
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
                        <div v-if="users.cardNumber">
                        <p v-if="isInValidCardNumber" class="error">有効な16桁のクレジットカード番号を入力してください。</p>
                        </div>
                        <v-row>
                            <label class="card-number-label" for="card-number-form" >カード番号</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="card-number-form"
                                dense
                                v-model="users.cardNumber"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <div v-if="users.expiration">
                        <p v-if="isInValidExpiration" class="error">数字4桁で入力してください(例 0520)</p>
                        </div>
                        <v-row>
                            <label class="expiration-label" for="expiration-form" >有効期限</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="expiration-form"
                                dense
                                v-model="users.expiration"
                                outlined
                                clearable
                                ></v-text-field>

                            </v-col>
                        </v-row>
                        <div v-if="users.cardName">
                        <p v-if="isInValidCardName" class="error">ローマ字で入力してください</p>
                        </div>
                        <v-row>
                            <label class="card-name-label" for="name-form" >メールアドレス</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="card-name-form"
                                dense
                                v-model="users.cardName"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <div v-if="users.cvc">
                        <p v-if="isInValidCvc" class="error">三桁の数字を入力してください</p>
                        </div>
                        <v-row>
                            <label class="cvc-label" for="cvc-form" >cvc</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                id="cvc-form"
                                dense
                                v-model="users.cvc"
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
                                @click="sendInformation()">
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
                users:{
                payment: this.$route.params.payment.toLocaleString(),
                name: null,
                kana: null,
                email: null,
                address: null,
                phone: null,
                cardNumber: null,
                expiration: null,
                cardName: null,
                cvc: null,

                },
                errors:[],
            }
        },
        methods:{
                sendInformation(){
                this.$router.push({name:"payment-confirmation",query:{
                    name:this.users.name,
                    kana:this.users.kana,
                    email:this.users.email,
                    address: this.users.address,
                    phone: this.users.phone,
                    cardNumber: this.users.cardNumber,
                    expiration: this.users.expiration,
                    cardName: this.users.cardName,
                    cvc: this.users.cvc,
                    payment: this.users.payment
                    }})
            }

        },
        mounted(){

        },
        computed:{
            isInvalidEmail(){
                const reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);
                return !reg.test(this.users.email);
            },
            isInValidName(){
                if(  this.users.name.length < 3 ){
                    return true
                }else{
                    return false
                }
            },
            isInValidKana(){
                if( this.users.kana.length < 3 ){
                    return true
                }else{
                    return false
                }
            },
            isInValidPhone(){
                if( this.users.phone.length < 9 || this.users.phone.length > 13 || isNaN(Number(this.users.phone)) ){
                    return true
                }else{
                    return false
                }
            },
            isInValidCvc(){
                if(  this.users.cvc.length < 3 || this.users.cvc.length > 3 ||  isNaN(Number(this.users.cvc)) ){
                    return true
                }else{
                    return false
                }
            },
            isInValidCardNumber(){
                if( this.users.cardNumber.length > 16 || this.users.cardNumber.length <16 || isNaN(Number(this.users.cardNumber)) ){
                    return true
                }else{
                    return false
                }
            },
            isInValidExpiration(){
                if( this.users.expiration.length > 4 || this.users.expiration.length < 4 || isNaN(Number(this.users.expiration)) ){
                    return true
                }else{
                    return false
                }
            },

            isInValidCardName(){
                const reg = new RegExp(/^[a-zA-Z][^$]*$/)
                return !reg.test(this.users.cardName)
            }


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
