<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <menu-component/>
            <v-container fill-height>
                <v-row class="mt-10">
                    <h2 class="login-title hidden-sm-and-down">サインイン</h2>
                </v-row>
                <v-row class="mt-10" >
                    <v-col align="center" justify="center" lg="6" md="6" sm='12' >
                        <div class="login-form">
                            <h3>ご登録済みのお客様</h3>
                            <v-divider class="mt-2 mb-2" width="80%"></v-divider>
                            <p class="login-explanation mt-4" >メールアドレスとパスワードを入力して<br>ログインしてください。</p>
                        </div>
                        <form @submit.prevent="login">
                        <p v-if="isInValidEmail" class="email-error">有効なメールアドレスを入力してください</p>
                        <v-row>
                            <v-col class="d-flex">
                                <p class="label mt-2 mr-4">メールアドレス</p>
                                <v-text-field
                                class="email-form"
                                dense
                                autocomplete="off"
                                v-model="email"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <p v-if="isInValidPassword" class="password-error">パスワードは8文字以上で入力してください</p>
                        <v-row class="mt-2">
                            <v-col class="d-flex" >
                                <p class="label mt-2 mr-11">パスワード</p>
                                <v-text-field
                                class="password-form"
                                dense
                                v-model="password"
                                outlined
                                v-bind:type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                v-bind:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                            <router-link to='/forgot-password'>
                                <p id="remember-password" >パスワードをお忘れですか？</p>
                            </router-link>
                            <h3 class="error-message mb-4">{{ message }}</h3>
                            <div class="login-button" >
                                <v-btn
                                class="py-3 px-15 h4 white--text"
                                color="black"
                                @click="login"
                                :disabled="isInValidEmail || isInValidPassword || isBlank"
                                >
                                ログイン</v-btn>
                            </div>
                        </form>

                            <router-link to='/google-redirect'>
                                <v-img
                                class="mt-4"
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/YG7QyW9bVnMZNfJaRmuiaaYc5f2xp5F2GlQbp170.png"
                                max-width="200"
                                >
                                </v-img>
                            </router-link>
                            <router-link to='/github-redirect'>
                                <v-img
                                class="mt-2 mb-16"
                                src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/4ITx9jjOw1lQPj26RA9em2a2xFxjaxEBn6YvBv4N.png"
                                max-width="200"
                                >
                                </v-img>
                            </router-link>
                    </v-col>
                    <v-col class="register-wrapper" align="center" justify="center">
                        <h3 class="">初めてご利用のお客様・会員以外の方</h3>
                        <v-divider width="80%" class="mt-2"></v-divider>
                        <p class="mt-6">初めてご利用のお客様はこちらから<br>会員登録を行ってください。</p>
                        <div id="register-button" >
                            <router-link to = "/register">
                                <v-btn
                                class="mt-2 mb-16 py-3 px-15 font-weight-bold white--text"
                                color="black"
                                >新規登録</v-btn>
                            </router-link>
                        </div>
                    </v-col>
                </v-row>

            </v-container>
        <footer-component/>
    </v-app>
</template>

<script>

    export default {

  data(){
    return {
      showPassword : false,
      email: null,
      password: "",
      message: null,
      token: null,
      isLoggedin: null,


    }
  },
    methods: {
        checkLogin(){
            if( this.$store.getters['userAuth/setToken'] ){
                this.isLoggedin = true
                this.$router.push("/")
            }else{
                this.isLoggedin = false
            }
        },
        login() {
            axios.post('api/login', {
                    email: this.email,
                    password: this.password
                    })
            .then(res => {
                console.log(res.data);
                this.message = res.data.message
                this.$store.dispatch('userAuth/setUsers', {name: res.data.user.name, auth: true, token: res.data.user.token});
                this.$router.push("/");
                this.message = res.data.message

            })
            .catch(error => {
                this.errors = error;
                console.log(error);
            });
        },
        googleLogin(){
            axios.get('api/google/login')
            .then(res =>{

            })


        }
        },

        mounted(){
            this.checkLogin()

        },
        computed:{
            isInValidEmail(){
                if(this.email){
                const reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);
                return !reg.test(this.email);
                }else{
                }
            },
            isInValidPassword(){
                if(this.password){
                    if(this.password.length < 8){
                        return true
                    }else{

                    }
                }else{

                }
            },
            isBlank(){
                if(!this.password || !this.email ){
                    return true
                }else{

                }

            }



        }

    }

</script>

<style lang="scss" scoped>
a:link, a:visited, a:hover, a:active{
    color:black;
    text-decoration: none;
}

#login-container{
    display: flex;
    align-items: center;

}
.label{
    white-space: nowrap;
}

.email-error{
    color: red;
    font-weight: bold;
}
.password-error{
    color: red;
    font-weight: bold;
}
.error-message{
    color: red;
}


</style>
