<template>
    <v-app>
        <admin-header-component/>
            <v-main>
                <h1 id="register-title">管理者ログイン</h1>
                    <div id="content-wrapper" >
                            <h3>管理者権限のあるメールアドレス・パスワードを入力してください。</h3>
                        <div id="login-divider">
                            <v-divider></v-divider>
                        </div>
                        <form @submit.prevent="adminLogin">
                        <v-row>
                            <label id="email-label" for="email-form" >メールアドレス</label>
                            <v-col cols="12" sm="4">
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
                            <v-col cols="12" sm="4"
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
                            <div id="login-button" >
                                <v-btn
                                class="py-3 px-15 font-weight-bold"
                                dark
                                color="black"
                                @click="adminLogin">
                                ログイン</v-btn>
                            </div>
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
      showPassword : false,
      email:'',
      password:'',
      isLoggedin: null,
    }
  },
  methods:{
    checkLogin(){
            if( this.$store.getters['adminAuth/setAdminToken'] ){
                this.isLoggedin = true

                this.$router.push("/admin-home")
            }else{
                this.isLoggedin = false
                console.log(this.$store.getters['adminAuth/setAdminToken']);
            }
    },
    adminLogin(){
        axios.post('api/admin/login', {
            email: this.email,
            password: this.password,
            })
        .then(res => {
            console.log(res.data);
            this.$store.dispatch('adminAuth/setAdmins', {name: res.data.admin.name, auth: true, token: res.data.admin.token});
            console.log(this.$store.getters['adminAuth/setAdminToken'])
            this.$router.push("admin-home");
        })
        .catch(error =>{
            console.log(error);
        });
        }
    },
    mounted(){
        this.checkLogin();
    }

}

</script>

<style lang="scss" scoped>

#register-title{
    margin-top:20px;
    margin-left:200px;
}

#content-wrapper{
    margin:40px 200px 200px 400px;
}
#login-divider{
    width:800px;
    margin-top:20px;
    margin-bottom: 30px;
}

#name-label{
    margin:20px;
    font-weight:bold;
    font-size:13px;
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

#register-button{

}




</style>
