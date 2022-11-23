<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
            <v-main>
                <h2 id="reset-title">パスワード再設定</h2>
                    <div id="content-wrapper" >
                            <h3></h3>
                        <div id="reset-divider">
                            <h3>新しく設定するパスワードを確認の上、変更してください。</h3>
                            <v-divider></v-divider>
                        </div>
                        <form @submit.prevent="resetPassword()">
                        <v-row>
                            <p>{{message}}</p>
                        </v-row>
                        <v-row>
                                <v-text-field
                                id="password-form"
                                dense
                                v-model="password"
                                outlined
                                v-bind:type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                v-bind:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                ></v-text-field>
                        </v-row>
                            <div id="reset-button" >
                                <v-btn
                                @click="resetPassword()"
                                class="py-3 px-15 font-weight-bold white--text"
                                color="black"
                                :disabled="isInValidPassword || clickOnce">
                                変更</v-btn>
                            </div>
                            <router-link to="/login">
                                <v-btn
                                v-if="buttonDisable"
                                class="py-3 px-15 font-weight-bold white--text"
                                color="black"
                                >
                                ログイン
                                </v-btn>
                            </router-link>

                        </form>
                    </div>
            </v-main>
        <footer-component/>
    </v-app>
</template>


<script>

    export default {

    data(){
        return {
        password:'',
        isLoggedin: null,
        showPassword : false,
        message: '',
        buttonDisable: false,
        }
    },
    methods:{
        checkLogin(){
            if( this.$store.getters['userAuth/setToken'] ){
                this.isLoggedin = true
                this.$router.push("/")
            }else{
                this.isLoggedin = false
            }
        },
        resetPassword() {
            axios.post('/api/password/reset',
            {password: this.password,token: this.$route.params.token ,email: this.$route.params.email})
            .then(response =>{
                this.message = response.data.message
                console.log(response);
                if(response.data.success){
                this.buttonDisable = true
                }else{

                }

            })
            .catch(error =>{
                this.errors = error.data.errors;
            })
        }

    },
    computed:{
        isInValidPassword(){
            if(this.password){
                if(this.password.length < 8){
                    return true
                }else{

                }
            }else{

            }
        },
        clickOnce(){
            if(this.buttonDisable){
                return true
            }else{
                return false
            }
        },

    }


    }
</script>

<style lang="scss" scoped>

a{
    text-decoration: none;
}

#reset-title{
    margin-top:20px;
    margin-left:200px;
}

#content-wrapper{
    margin:40px 200px 200px 400px;
}
#register-divider{
    width:800px;
    margin-top:20px;
    margin-bottom: 30px;
}

#email-label{
    margin:20px;
    font-weight:bold;
    font-size:13px;
}

#password-label{
    margin:20px;
    font-weight:bold;
    font-size:13px;
}

#reset-button{

}




</style>
