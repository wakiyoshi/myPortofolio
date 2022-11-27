<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
            <v-container fluid>
                <v-row class="mt-6 hidden-sm-and-down" align="center" justify="center" >
                    <v-btn
                        class="px-10 py-6 mr-4 white--text"
                        color="black"><h2>情報入力</h2></v-btn>
                    <h2 class="arrow-signs">>>></h2>
                    <v-btn
                    class="px-10 py-6 mr-4 ml-4 white--text"
                    color="grey"><h2>情報確認</h2></v-btn>
                    <h2 class="arrow-signs">>>></h2>
                    <v-btn
                    class="px-10 py-6 mr-4 ml-4 white--text"
                    color="grey"><h2>注文完了</h2></v-btn>
                </v-row>


                    <v-col align="center" justify="center">
                    <h2 class="mt-6">ご注文内容確認の上決済情報を入力してください</h2>
                    <v-divider width="60%"></v-divider>
                    <h3 class="mt-4 mb-4" v-if="users.payment">決済金額: {{ users.payment }} 円</h3>
                    <v-divider class="mb-10"></v-divider>

                    <form @submit.prevent="sendInformation">
                            <v-col v-if="users.name">
                                <p v-if="isInValidName" class="form-error mb-2">名前は２文字以上で入力してください</p>
                            </v-col>
                        <v-row >
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">名前</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                <v-text-field
                                id="name-form"
                                placeholder="田中 太郎"
                                dense
                                v-model="users.name"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-col v-if="users.kana">
                            <p v-if="isInValidKana" class="form-error">カナは２文字以上で入力してください</p>
                        </v-col>
                        <v-row>
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">氏名カナ</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                <v-text-field
                                placeholder="タナカ タロウ"
                                id="kana-form"
                                dense
                                v-model="users.kana"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-col v-if="users.email">
                            <p v-if="isInValidEmail" class="form-error">有効なメールアドレスを入力してください</p>
                        </v-col>
                        <v-row>
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">メールアドレス</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
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
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">発送先住所</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
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


                        <v-col v-if="users.phone">
                            <p v-if="isInValidPhone" class="form-error">有効な電話番号を入力してください。</p>
                        </v-col>
                        <v-row>
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">電話番号</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
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
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col  lg="2" md="2" sm="2" cols="2">
                                <p>お支払い方法<br>(クレジットカード)</p>
                            </v-col>
                            <v-col lg="4" md="4" sm="8" cols="8">

                                <v-img
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/wJPj9JUodV94zYeI7nVv3SBPBVAyJ2BrTSzyHRq8.png"
                                max-width="400">
                                </v-img>
                            </v-col>
                        </v-row>

                        <v-col v-if="users.cardNumber">
                            <p v-if="isInValidCardNumber" class="form-error">有効な16桁のクレジットカード番号を入力してください。</p>
                        </v-col>
                        <v-row>
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">カード番号</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                <v-text-field
                                placeholder="111122223333XXXX"
                                id="card-number-form"
                                dense
                                v-model="users.cardNumber"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-col v-if="users.expiration">
                            <p v-if="isInValidExpiration" class="form-error">数字4桁で入力してください(例 0520)</p>
                        </v-col>
                        <v-row>
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">有効期限</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                <v-text-field
                                placeholder="0520"
                                id="expiration-form"
                                dense
                                v-model="users.expiration"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-col v-if="users.cardName">
                            <p v-if="isInValidCardName" class="form-error">ローマ字で入力してください</p>
                        </v-col>
                        <v-row>
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">カード名義</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                    <v-text-field
                                    placeholder="TANAKA TAROU"
                                    id="card-name-form"
                                    dense
                                    v-model="users.cardName"
                                    outlined
                                    clearable
                                    ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-col v-if="users.cvc">
                            <p v-if="isInValidCvc" class="form-error">三桁の数字を入力してください</p>
                        </v-col>
                        <v-row>
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">CVC</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                <v-text-field
                                placeholder="111"
                                id="cvc-form"
                                dense
                                v-model="users.cvc"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>

                                <v-btn
                                class="mt-16 mb-16 py-3 px-15 font-weight-bold white--text"
                                color="black"
                                @click="sendInformation()"
                                :disabled="isInValidEmail || isInValidName || isInValidKana || isInValidAddress || isInValidPhone || isInValidCvc || isInValidCardNumber || isInValidExpiration || isInValidCardName || isBlank">
                                確認に進む
                                </v-btn>


                        </form>
                    </v-col>

            </v-container>
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

.arrow-signs{
    color: lightgray;
}
p{
    font-weight: bold;
    white-space: nowrap;
}
.form-error{
    color: red;

}
.credit-information{
    background-color: lightgray;
}


</style>
