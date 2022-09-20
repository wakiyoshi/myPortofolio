<template>
    <v-app>
        <v-main>
        <campaign-component/>
        <header-component/>
        <menu-component/>

                <h2 id="login-title" >ログイン</h2>
                <div id="login-container" >
                    <div id="content-wrapper" >
                        <div id="login-form">
                            <h3>ご登録済みのお客様</h3>
                        <div id="login-divider" >
                            <v-divider></v-divider>
                        </div>
                            <p class="login-explanation" >メールアドレスとパスワードを入力してログインしてください。</p>
                        </div>
                        <form @submit.prevent="login" >


                        <p v-if="isInValidEmail" class="error">有効なメールアドレスを入力してください</p>
                        <v-row>
                            <label id="email-label" for="email-form" >メールアドレス</label>
                            <v-col cols="12" sm="8">
                                <v-text-field
                                id="email-form"
                                dense
                                autocomplete="off"
                                v-model="email"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <p v-if="isInValidPassword" class="error">パスワードは8文字以上で入力してください</p>

                        <v-row>
                            <label id="password-label" for="password-form" >パスワード</label>
                            <v-col cols="12" sm="8"
                            >
                                <v-text-field
                                id="password-form"
                                dense
                                v-model="password"
                                outlined

                                v-bind:type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                v-bind:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                ></v-text-field>

                            </v-col>
                        </v-row>
                            <router-link to='/reset-password'>
                                <p id="remember-password" >パスワードをお忘れですか？</p>
                            </router-link>
                            <div class="login-button" >
                                <v-btn
                                class="py-3 px-15 font-weight-bold white--text"
                                color="black"
                                @click="login"
                                :disabled="isInValidEmail || isInValidPassword"
                                >
                                ログイン</v-btn>
                            </div>
                        </form>

                            <a href="/auth/redirect">
                                <v-img
                                src="/img/google_button.png"
                                max-width="200"
                                >
                                </v-img>
                            </a>
                            <a href="/github/login">
                                <v-img
                                src="/img/github_button.png"
                                max-width="200"
                                >
                                </v-img>
                            </a>
                    </div>
                    <div id="register-link" >
                        <h3>初めてご利用のお客様・会員以外の方</h3>
                        <div id="register-divider" style='height:10px; width:470px; margin-top: 10px; margin-bottom: 15px;'>
                            <v-divider></v-divider>
                        </div>
                        <p>初めてご利用のお客様は、こちらから会員登録を行ってください。<br>会員登録しておくと便利に買い物ができるようになります。</p>
                        <div id="register-button" >
                            <router-link to = "/register">
                            <v-btn
                            class="py-3 px-15 font-weight-bold white--text"
                            color="black"

                            >新規登録</v-btn>
                            </router-link>
                        </div>
                    </div>

                </div>


        <footer-component/>
        </v-main>

    </v-app>
</template>

<script>

    export default {

  data(){
    return {
      showPassword : false,
      email: null,
      password: "",
      errors: [],
      token: null,


    }
  },
    methods: {

        login() {

            axios.post('/login', {
                    email: this.email,
                    password: this.password
                    })
            .then(res => {
                console.log(res.data);
                this.$store.dispatch('userAuth/setUsers', {name: res.data.user.name, auth: true, token: res.data.user.token});
                this.$router.push("/user-home");
            })
            .catch(error => {
                this.errors = error;
            });

        },

        },
        mounted(){

        },
        computed:{
            isInValidEmail(){
                const reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);

                return !reg.test(this.email);
            },
            isInValidPassword(){
                if(this.password.length < 8){
                    return true
                }else{
                    return false
                }
            },


        }






  }

</script>

<style lang="scss" scoped>

#login-title{
    margin-top:20px;
    margin-left:200px;
}
#login-container{
    display: flex;
}
#content-wrapper{
    margin:40px 100px 200px 250px;
}
#login-divider{
    width:470px;
    margin-top:10px;
    margin-bottom: 15px;
}
#login-explanation{
    padding-bottom: 20px;
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
#remember-password{
    font-size:10;
    text-align: center;
}
.login-button{
    text-align:center;
}

#register-link{
    margin:40px 400px 80px 35px;
}
#register-button{
    text-align:center; margin-top:60;
}





</style>
