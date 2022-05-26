<template>
    <v-app>
        <header-component/>
        <menu-component/>
            <v-main >
            <h2 style="margin-top:20px; margin-left:100px">ログイン</h2>
            <div style="display:flex; ">
                <div style="margin:40px 200px 200px 400px;">
                    <div>
                        <h3>ご登録済みのお客様</h3>
                    <div style='border-width:5px 0 0 0; width:470px; margin-top:10px;margin-bottom: 15px;'>
                        <v-divider></v-divider>
                    </div>
                        <p style="padding-bottom: 20px;">メールアドレスとパスワードを入力してログインしてください。</p>
                    </div>
                    <v-row>
                        <label for="login-form" style=" margin:20px; font-weight:bold; font-size:13px;">メールアドレス</label>
                        <v-col cols="12" sm="8">
                            <v-text-field

                            id="login-form"

                            dense
                            v-model="email"
                            outlined
                            clearable
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <label for="password-form" style="margin:20px; font-weight:bold;font-size:13px;">パスワード</label>
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
                            <p style="font-size:10; text-align: center;">パスワードをお忘れですか？</p>
                        </router-link>
                        <div style="text-align:center;">
                            <v-btn
                            class="py-3 px-15 font-weight-bold"
                            dark
                            color="black">
                            ログイン</v-btn>
                        </div>
                </div>
                <div id="register-link" style="margin:40px 400px 80px 35px;">
                    <h3>初めてご利用のお客様・会員以外の方</h3>
                    <div style='height:10px; width:470px; margin-top: 10px; margin-bottom: 15px;'>
                        <v-divider></v-divider>
                    </div>
                    <p>初めてご利用のお客様は、こちらから会員登録を行ってください。<br>会員登録しておくと便利に買い物ができるようになります。</p>
                    <div style="text-align:center; margin-top:60;">
                        <v-btn
                        class="py-3 px-15 font-weight-bold"
                        color="black"
                        dark
                        >新規登録</v-btn>
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
