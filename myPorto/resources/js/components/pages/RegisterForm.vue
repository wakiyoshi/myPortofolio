<template>
    <v-app>
        <campaign-component/>
        <header-component/>
        <menu-component/>
            <v-main>
                <h2 id="register-title" >新規登録</h2>

                    <div id="content-wrapper" >

                            <h3>ご登録するお名前、メールアドレス、パスワード<br>ご確認の上、『新規会員登録ボタン』を押し、会員登録を完了してください。</h3>
                        <div id="register-divider">
                            <v-divider></v-divider>
                        </div>
                        <form @submit.prevent="register">
                        <v-row>

                            <label id="name-label" for="name-form" >名前</label>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                id="name-form"
                                dense
                                v-model="name"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
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
                            <div id="register-button" >
                                <v-btn
                                class="py-3 px-15 font-weight-bold"
                                dark
                                color="black"
                                @click="register">
                                新規会員登録</v-btn>
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
      name:'',
      email:'',
      password:'',
    }
  },
  methods:{
    register(){
    axios.post('/register', {
        name: this.name,
        email: this.email,
        password: this.password,
        })
    .then(response => {
        console.log(response);
        this.$router.push("/login");
    })
    .catch(error =>{
        console.log(error);
    });
    }

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
#register-divider{
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
