<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
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
                                placeholder="例： 田中 太郎"
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
                                placeholder="例： タナカ タロウ"
                                id="kana-form"
                                dense
                                v-model="users.kana"
                                outlined
                                clearable
                                ></v-text-field>

                            </v-col>
                        </v-row>
                        <div v-if="users.email">
                        <p v-if="isInValidEmail" class="error">有効なメールアドレスを入力してください</p>
                        </div>
                        <v-row>
                            <label class="email-label" for="email-form" >メールアドレス</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                placeholder="example@mail.com"
                                id="email-form"
                                dense
                                v-model="users.email"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <p v-if="isInValidAddress" class="error">有効な住所を入力してください。</p>
                            <label class="address-label" for="address-form" >お届け先住所</label>
                            <v-col cols="12" sm="4"
                            >
                                <v-text-field
                                placeholder="〇〇県〇〇市〇〇町 １−１−１ (インテリハイツ111号室)"
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
                                placeholder="080-1111-XXXX"
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
                                placeholder="例：111122223333XXXX (ハイフン(-)を除く14~16桁)"
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
                                placeholder="例：0520 (スラッシュ(/)を除く４桁)"
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
                            <label class="card-name-label" for="name-form" >カード名義</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                placeholder="例：TANAKA TAROU"
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
                                placeholder="例：111"
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
                                class="py-3 px-15 font-weight-bold white--text"
                                color="black"
                                @click="sendInformation()"
                                :disabled="isInValidEmail || isInValidName || isInValidKana || isInValidAddress || isInValidPhone || isInValidCvc || isInValidCardNumber || isInValidExpiration || isInValidCardName || isBlank">
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
                payment: this.$route.query.payment.toLocaleString(),
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
            sendInformation(){
            this.$router.push({name:"payment-confirmation",query:{
                productName: this.productName,
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
            this.checkLogin()
        },
        computed:{

            isInValidName(){
                if(this.users.name){
                    if(  this.users.name.length < 3 ){
                        return true
                    }else{
                        return false
                    }
                }else{

                }
            },
            isInValidKana(){
                if(this.users.kana){
                    if( this.users.kana.length < 3 ){
                        return true
                    }else{
                        return false
                    }
                }else{

                }
            },
            isInValidAddress(){
                if(this.users.address){
                    if(this.users.address.length < 10){
                        return true
                    }else{
                        return false
                    }
                }

            },
            isInValidEmail(){
                if(this.users.email){
                    const reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);
                    return !reg.test(this.users.email);
                }else{

                }
            },
            isInValidPhone(){
                if(this.users.phone){
                    if( this.users.phone.length < 9 || this.users.phone.length > 13 || isNaN(Number(this.users.phone)) ){
                        return true
                    }else{
                        return false
                    }
                }
            },
            isInValidCvc(){
                if(this.users.cvc){
                    if(  this.users.cvc.length < 3 || this.users.cvc.length > 3 ||  isNaN(Number(this.users.cvc)) ){
                        return true
                    }else{
                        return false
                    }
                }
            },
            isInValidCardNumber(){
                if(this.users.cardNumber){
                    if( this.users.cardNumber.length > 16 || this.users.cardNumber.length <16 || isNaN(Number(this.users.cardNumber)) ){
                        return true
                    }else{
                        return false
                    }
                }
            },
            isInValidExpiration(){
                if(this.users.expiration){
                    if( this.users.expiration.length > 4 || this.users.expiration.length < 4 || isNaN(Number(this.users.expiration)) ){
                        return true
                    }else{
                        return false
                    }
                }
            },

            isInValidCardName(){
                if(this.users.cardName){
                const reg = new RegExp(/^[a-zA-Z][^$]*$/)
                return !reg.test(this.users.cardName)
                }
            },
            isBlank(){
                if(  !this.users.name || !this.users.kana || !this.users.email || !this.users.address || !this.users.phone || !this.users.cardNumber || !this.users.expiration || !this.users.cardName || !this.users.cvc){
                    return true
                }else{
                    return false

                }

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
