<template>
    <v-app>
        <campaign-component/>
        <header-component/>
        <menu-component/>
            <v-main>
                <h2 id="login-title" >ログイン</h2>
                <div id="login-container" >
                    <div id="content-wrapper" >
                        <div id="login-form">
                            <h3>ご登録済みのお客様</h3>
                        <div id="login-divider" >
                            <v-divider></v-divider>
                        </div>
                            <p id="login-explanation" >メールアドレスとパスワードを入力してログインしてください。</p>
                        </div>
                        <v-row>
                            <label id="email-label" for="email-form" >メールアドレス</label>
                            <v-col cols="12" sm="8">
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
                            <label id="password-label" for="password-form" >パスワード</label>
                            <v-col cols="12" sm="8"
                            >
                                <v-text-field
                                id="password-form"
                                dense
                                v-model="password"
                                outlined
                                clearable
                                v-bind:type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                v-bind:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"

                                ></v-text-field>
                            </v-col>
                        </v-row>
                            <router-link to='/'>
                                <p id="remember-password" >パスワードをお忘れですか？</p>
                            </router-link>
                            <div id="login-button" >
                                <v-btn
                                class="py-3 px-15 font-weight-bold"
                                dark
                                color="black">
                                ログイン</v-btn>
                            </div>
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
                            class="py-3 px-15 font-weight-bold"
                            color="black"
                            dark
                            >新規登録</v-btn>
                            </router-link>
                        </div>
                    </div>
                </div>

            </v-main>
        <footer-component/>

    </v-app>
</template>


<script>

    export default {

  data(){
    return {
      showPassword : false,
      email:'',
      password:'',
    }
  },
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
    margin:40px 200px 200px 400px;
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
#login-button{
    text-align:center;
}
#register-link{
    margin:40px 400px 80px 35px;
}
#register-button{
    text-align:center; margin-top:60;
}



</style>
