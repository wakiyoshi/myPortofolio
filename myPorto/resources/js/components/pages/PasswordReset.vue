<template>
    <v-app>
        <campaign-component/>
        <header-component/>
        <menu-component/>
            <v-main>
                <h2 id="reset-title">パスワード再設定</h2>
                    <div id="content-wrapper" >
                            <h3></h3>
                        <div id="reset-divider">
                            <h3>登録済みのメールアドレスを入力のうえ、送信してください。<br>その後、ご入力いただいたメールアドレスに届くurlよりパスワードの再設定をお願いします。</h3>
                            <v-divider></v-divider>
                        </div>
                        <form @submit.prevent="sendResetEmail">
                        <v-row>
                            <label id="email-label" for="email-form" >メールアドレス</label>
                            <v-col cols="12" sm="12">
                                <v-text-field
                                id="email-form"
                                dense
                                v-model="email"
                                outlined
                                clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                            <div id="reset-button" >
                                <v-btn
                                @click="sendResetEmail"
                                class="py-3 px-15 font-weight-bold"
                                dark
                                color="black">
                                送信</v-btn>
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
      email:'',
    }
  },
  methods:{
      sendResetEmail() {
        axios.post('/api/reset-password',
        {email: this.email})
        .then(response =>{
            console.log(response);
        })
        .catch(error =>{
            this.errors = error.response.data.errors;
        })
      }
  }

    }
</script>

<style lang="scss" scoped>

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
