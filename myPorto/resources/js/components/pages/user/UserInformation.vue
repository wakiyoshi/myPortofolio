<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <v-container fluid>
            <v-row class="mt-4" >
                <v-col align="center" justify="center">
                    <h3>変更したい項目を入力し直し、<br>変更を確定する場合は更新ボタンを押してください。</h3>
                </v-col>
            </v-row>
            <v-divider class="mt-6 mb-10"></v-divider>
            <v-col align="center" justify="center">
                <form @submit.prevent="sendInformation">
                        <p v-if="isInValidName" class="form-error mb-2">名前は2文字以上で入力してください</p>
                        <v-row class="">
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">名前</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                <v-text-field
                                id="name-form"
                                dense
                                v-model="users.name"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    <p v-if="isInValidEmail" class="form-error mb-2">有効なメールアドレスを入力してください</p>
                        <v-row class="">
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">メールアドレス</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                <v-text-field
                                id="email-form"
                                dense
                                v-model="users.email"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="">
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">発送先住所</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                    <v-text-field
                                    id="address-form"
                                    dense
                                    v-model="users.shipping_address"
                                    outlined
                                    clearable>
                                    </v-text-field>
                            </v-col>
                        </v-row>
                            <p v-if="isInValidPhone" class="form-error mb-2">有効な電話番号を入力してください。</p>
                        <v-row class="">
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">電話番号</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                    <v-text-field
                                    id="phone-form"
                                    dense
                                    v-model="users.phone_number"
                                    outlined
                                    clearable
                                    auto-complete="off"
                                    ></v-text-field>
                            </v-col>
                        </v-row>
                        <h3 class="mt-6">クレジットカード情報</h3>
                        <v-divider class="mt-8 mb-10"></v-divider>
                            <p v-if="isInValidCardNumber" class="form-error mb-2">有効な16桁のクレジットカード番号を入力してください。</p>
                        <v-row >
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">カード番号</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                    <v-text-field
                                    id="card-number-form"
                                    dense
                                    v-model="users.card_number"
                                    outlined
                                    clearable
                                    ></v-text-field>
                            </v-col>
                        </v-row>
                            <p v-if="isInValidExpiration" class="form-error mb-2">数字4桁で入力してください(例 0520)</p>
                        <v-row class="">
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">有効期限</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                    <v-text-field
                                    id="expiration-form"
                                    dense
                                    v-model="users.expiration_date"
                                    outlined
                                    clearable
                                    ></v-text-field>
                            </v-col>
                        </v-row>


                            <p v-if="isInValidCardName" class="form-error mb-2">ローマ字で入力してください</p>
                        <v-row class="">
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">カード名義</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                    <v-text-field
                                    id="card-name-form"
                                    dense
                                    v-model="users.card_name"
                                    outlined
                                    clearable
                                    ></v-text-field>
                            </v-col>
                        </v-row>

                            <p v-if="isInValidCvc" class="form-error mb-2">三桁の数字を入力してください</p>
                        <v-row class="">
                            <v-col lg="1" md="1" sm="1" cols="1">
                                <v-spacer></v-spacer>
                            </v-col>
                            <v-col lg="2" md="2" sm="2" cols="2">
                                <p class="mt-2">CVC</p>
                            </v-col>
                            <v-col lg="8" md="8" sm="8" cols="8">
                                    <v-text-field
                                    id="cvc-form"
                                    dense
                                    v-model="users.cvc"
                                    outlined
                                    clearable
                                    ></v-text-field>
                            </v-col>
                        </v-row>

                            <v-row>
                                <v-col v-if="errors.length !== 0 | !errors">
                                    <tr v-for="(error,index) in errors" :key="index">
                                        <td> <h3>{{ error }}</h3></td>
                                    </tr>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col class="sendbutton mt-10 mb-16">
                                    <v-btn
                                    class="py-3 px-15 font-weight-bold"
                                    dark
                                    color="black"
                                    @click="sendInformation">
                                    更新</v-btn>
                                </v-col>
                            </v-row>
                            <v-btn
                                @click="logout" color="white" ><h4>ログアウト</h4>
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
                users: [],
                errors: [],
            }
        },
        methods:{
            checkLogin(){
                if( this.$store.getters['userAuth/setToken']){
                    this.isLoggedin = true

                    console.log(this.$store.getters['userAuth/setToken']);
                }else{
                    this.isLoggedin = false
                    this.$router.push('/login')
                }
            },
            getUserInfo(){
                axios.get('/api/user/information',{
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(response =>{
                    this.users = response.data
                    console.log(response.data)

                })
                .catch(error =>{
                    console.log(error);
                })
            },
            sendInformation(){
                axios.post('/api/change/info', {
                    name:this.users.name,
                    email:this.users.email,
                    shipping_address: this.users.shipping_address,
                    phone_number: this.users.phone_number,
                    card_number: this.users.card_number,
                    expiration_date: this.users.expiration_date,
                    card_name: this.users.card_name,
                    cvc: this.users.cvc,
                })
                .then(response =>{
                    console.log(response.data)

                    this.getUserInfo();

                }).catch(err =>{
                    const array = err.response.data.errors
                    Object.keys(array).forEach(key => this.errors.push(array[key][0]))
                })

            },
            logout(){
                this.$store.dispatch('userAuth/setUsers', {name: null ,auth:false ,token: null})
                this.$router.push("/login",()=>{})
            },

        },
        created(){
            this.checkLogin();
            this.getUserInfo();

        },
        computed:{
            isInValidEmail(){
                if(this.users.email){
                const reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);
                return !reg.test(this.users.email);
                }else{

                }
            },
            isInValidName(){
                if(this.users.name){
                    if(this.users.name.length < 3 || this.users.name === null){
                        return true
                    }else{
                        return false
                    }
                    }else{

                }
            },
            isInValidPhone(){
                if(this.users.phone_number){
                    if( this.users.phone_number.length < 9 || this.users.phone_number.length > 13 || isNaN(Number(this.users.phone_number)) ){
                        return true
                    }else{
                        return false
                    }
                }else{


                }
            },
            isInValidCvc(){
                if(this.users.cvc){
                    if(  this.users.cvc.length > 3 ||this.users.cvc.length < 3|| isNaN(Number(this.users.cvc)) ){
                        return true
                    }else{
                        return false
                    }
                }else{

                }
            },
            isInValidCardNumber(){
                if(this.users.card_number){
                    if(  this.users.card_number.length > 16 || this.users.card_number.length < 16 || isNaN(Number(this.users.card_number)) ){
                        return true
                    }else{
                        return false
                    }
                }else{

                }
            },
            isInValidExpiration(){
                if(this.users.expiration_date){
                    if( this.users.expiration_date.length > 4 || this.users.expiration_date.length < 4|| isNaN(Number(this.users.expiration_date)) ){
                        return true
                    }else{
                        return false
                    }
                }else{
                }
            },

            isInValidCardName(){
                if(this.users.card_name){
                const reg = new RegExp(/^[a-zA-Z][^$]*$/)
                return !reg.test(this.users.card_name)
                }else{
                }
            }
        },
        }
</script>

<style scoped>

p{
    font-weight: bold;
}
.information-form{
    text-align: center;

}
.form-error{
    color: red;
}



</style>
