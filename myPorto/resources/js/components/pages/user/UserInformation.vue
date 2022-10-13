<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <v-main>
            <div id="container">
                <div class="information-form" v-if="users">
                    <h3>変更したい項目を入力し直してください<br>変更を確定する場合は更新ボタンを押してください</h3>
                    <v-divider></v-divider>
                    <div>
                        <form @submit.prevent="sendInformation">
                            <p v-if="isInValidName" class="error">名前は２文字以上で入力してください</p>
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
                            <p v-if="isInValidEmail" class="error">有効なメールアドレスを入力してください</p>
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
                                    v-model="users.shipping_address"
                                    outlined
                                    clearable
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <p v-if="isInValidPhone" class="error">有効な電話番号を入力してください。</p>
                            <v-row>
                                <label class="phone-label" for="phone-form" >電話番号</label>
                                <v-col cols="12" sm="4"
                                >
                                    <v-text-field
                                    id="phone-form"
                                    dense
                                    v-model="users.phone_number"
                                    outlined
                                    clearable
                                    ></v-text-field>
                                </v-col>

                            </v-row>
                            <h3>クレジットカード情報</h3>
                            <v-divider></v-divider>
                            <p v-if="isInValidCardNumber" class="error">有効な16桁のクレジットカード番号を入力してください。</p>
                            <v-row>
                                <label class="card-number-label" for="card-number-form" >カード番号</label>
                                <v-col cols="12" sm="4">
                                    <v-text-field
                                    id="card-number-form"
                                    dense
                                    v-model="users.card_number"
                                    outlined
                                    clearable
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <p v-if="isInValidExpiration" class="error">数字4桁で入力してください(例 0520)</p>
                            <v-row>
                                <label class="expiration-label" for="expiration-form" >有効期限</label>
                                <v-col cols="12" sm="4"
                                >
                                    <v-text-field
                                    id="expiration-form"
                                    dense
                                    v-model="users.expiration_date"
                                    outlined
                                    clearable
                                    ></v-text-field>

                                </v-col>
                            </v-row>
                            <p v-if="isInValidCardName" class="error">ローマ字で入力してください</p>
                            <v-row>
                                <label class="card-name-label" for="name-form" >カード名義</label>
                                <v-col cols="12" sm="4">
                                    <v-text-field
                                    id="card-name-form"
                                    dense
                                    v-model="users.card_name"
                                    outlined
                                    clearable
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <p v-if="isInValidCvc" class="error">三桁の数字を入力してください</p>
                            <v-row>
                                <label class="cvc-label" for="cvc-form" >CVC</label>
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
                                    @click="sendInformation">

                                    更新</v-btn>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </v-main>
    </v-app>

</template>

<script>
    export default {

        data(){
            return{
                users: [],
                name: null,
                email: null,
                shipping_address: null,
                phone_number: null,
                card_number: null,
                expiration_date: null,
                card_name: null,
                cvc: null,
                errors:[],
            }
        },
        methods:{

            checkLogin(){
                if( this.$store.getters['userAuth/setToken']){
                    this.isLoggedin = true
                }else{
                    this.isLoggedin = false
                    this.$router.push('/login')
                }
            },
            getUserInfo(){
                axios.get('/api/user/information/',{
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(response =>{
                    this.users = response.data
                    console.log(response.data)

                })
                .catch(error=>{
                    console.log(error);
                })
            },
            sendInformation(){
                axios.post('/api/change/info', {
                    name:this.users.name,
                    email:this.users.email,
                    address: this.users.shipping_address,
                    phone: this.users.phone_number,
                    cardNumber: this.users.card_number,
                    expiration: this.users.expiration_date,
                    cardName: this.users.card_name,
                    cvc: this.users.cvc,
                })
                .then(response =>{
                    console.log(response)
                    this.getUserInfo();

                })

            }

        },
        created(){
            this.getUserInfo();

        },
        computed:{
            isInValidEmail(){
                const reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);
                return !reg.test(this.users.email);
            },
            isInValidName(){
                if(this.users.name.length < 3 ){
                    return true
                }else{
                    return false
                }
            },
            isInValidPhone(){
                if( this.users.phone_number.length < 9 || this.users.phone_number.length > 13 || isNaN(Number(this.users.phone_number)) ){
                    return true
                }else{
                    return false
                }
            },
            isInValidCvc(){
                if(   this.users.cvc.length < 3 || this.users.cvc.length >= 4 ||  isNaN(Number(this.users.cvc)) ){
                    return true
                }else{
                    return false
                }
            },
            isInValidCardNumber(){
                if(  this.users.card_number.length > 16 || this.users.card_number.length < 16 || isNaN(Number(this.users.card_number)) ){
                    return true
                }else{
                    return false
                }
            },
            isInValidExpiration(){
                if( this.users.expiration_date > 4 || this.users.expiration_date < 4 || isNaN(Number(this.users.expiration_date)) ){
                    return true
                }else{
                    return false
                }
            },
            isInValidCardName(){
                const reg = new RegExp(/^[a-zA-Z][^$]*$/)
                return !reg.test(this.users.card_name)
            }


        },


        }
</script>

<style scoped>
#container{
    text-align: center;

}
.information-form{
    text-align: center;

}


</style>
