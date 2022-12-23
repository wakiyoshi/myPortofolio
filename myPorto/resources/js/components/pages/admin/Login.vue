<template>
    <v-app>
        <admin-header-component/>
            <v-container fluid>
                <v-row >
                    <v-col align="center">
                        <h2 class="mb-6">管理者ログイン</h2>
                        <h4>管理者権限のあるメールアドレス・パスワードを入力してください。</h4>
                        <v-divider class="mt-4" width="45%"></v-divider>
                        <form @submit.prevent="adminLogin">
                        <v-row align="center" justify="center" class="mt-6">
                            <v-col lg="6" md="6" cols="8" sm="8" class="d-flex" >
                                <h5 class="email-label mt-2 mr-4" >メールアドレス</h5>
                                    <v-text-field
                                    id="email-form"
                                    dense
                                    v-model="email"
                                    outlined
                                    clearable
                                    ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row align="center" justify="center" class="">
                            <v-col lg="6" md="6" cols="8" sm="8" class="d-flex">
                                <h5 class="password-label mt-2 mr-12" >パスワード</h5>
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
                            <v-row v-if="message">
                                <v-col align="center" justify="center">
                                    <h3 class="red--text">{{ message }}</h3>
                                </v-col>
                            </v-row>
                            <v-col class="mt-6 mb-16" >
                                <v-btn
                                class="py-3 px-15 font-weight-bold"
                                dark
                                color="black"
                                @click="adminLogin">
                                ログイン</v-btn>
                            </v-col>
                        </form>
                    </v-col>
                </v-row>
            </v-container>
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
      message: null,
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
            this.message = error.response.data.errors
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
