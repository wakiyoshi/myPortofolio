<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
            <v-main>
                <h2 id="reset-title">パスワード再設定</h2>
                    <div id="content-wrapper" >
                            <h3></h3>
                        <v-row>
                            <h3>登録済みのメールアドレスを入力のうえ、送信してください。<br>その後、ご入力いただいたメールアドレスに届くurlよりパスワードの再設定をお願いします。</h3>
                            <v-divider></v-divider>
                        </v-row>
                        <form @submit.prevent="sendResetEmail">
                        <v-row>
                            <p>{{ message }}</p>
                        </v-row>
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
                                class="py-3 px-15 font-weight-bold white--text"
                                color="black"
                                :disabled=" isInValidEmail || clickOnce ">
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
        isLoggedin: null,
        message: '',
        errors: '',
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
        sendResetEmail() {
            axios.post('/api/password/request',
            {email: this.email})
            .then(response =>{
                console.log(response);
                this.message = response.data.message
                this.buttonDisable = true
            })
            .catch( error=>{
                console.log(error);
            })
        }

    },
    computed:{
            isInValidEmail(){
                if(this.email){
                const reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);
                return !reg.test(this.email);
                }else{
                    return true;

                }
            },
            clickOnce(){
                if(this.buttonDisable){
                    return true
                }else{
                    return false
                }
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
