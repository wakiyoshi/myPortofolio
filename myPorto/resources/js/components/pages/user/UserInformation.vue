<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <v-main>
            <div id="container">
                <div class="information-form">
                    <h3>変更したい項目を入力し直してください<br>変更を確定する場合は更新ボタンを押してください</h3>
                    <v-divider></v-divider>
                    <div v-if="users">
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
                                v-model="users.name"
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
                users: null,
                name: "",

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
            getUserInfo(){
                axios.get('/api/user/info')
                .then(response =>{
                    this.users = response.data
                    console.log(response.data)
                })
                .catch(error=>{
                    console.log(error);
                })

            },
            sendInformation(){
                axios.post('/api/change/info',{
                    name:this.users.name,
                    email:this.users.email,
                    address: this.users.shipping_address,
                    phone: this.users.phone_number,
                    cardNumber: this.users.card_number,
                    expiration: this.users.expiration_date,
                    cardName: this.users.card_number,
                    cvc: this.users.cvc,
                })
                .then(response =>{
                    console.log(response)
                    this.getUserInfo();

                })

            }

        },
        mounted(){
            this.getUserInfo();

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
