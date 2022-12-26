<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
            <v-container fill-height>

                <v-row>
                    <v-col align="center" justify="center">
                        <h4 class="mt-10 mb-4">ご登録するお名前、メールアドレス、パスワードをご確認の上、<br>『新規会員登録ボタン』を押し、会員登録を完了してください。</h4>
                        <v-divider class="mb-10" width="60%"></v-divider>
                        <p v-if="isInValidName" class="name-error">名前は3文字以上で入力してください</p>
                        <form @submit.prevent="register">
                        <v-row align="center" justify="center">
                            <v-col class="d-flex" xl="6" lg="6" md="6"  sm="7" cols="10">
                                <h5 class="name-label mt-2" >名前</h5>
                                <v-text-field
                                dense
                                v-model="name"
                                outlined
                                clearable
                                autocomplete="off"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <p v-if="isInValidEmail" class="error">有効なメールアドレスを入力してください</p>
                            <v-row align="center" justify="center">
                                <v-col  class="d-flex" xl="6" lg="6" md="6"  sm="7" cols="10">
                                    <h5 class="label mt-2 mr-7" >メールアドレス</h5>
                                    <v-text-field
                                    class="email-form"
                                    dense
                                    v-model="email"
                                    outlined
                                    clearable
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        <p v-if="isInValidPassword" class="error">パスワードは8文字以上で入力してください</p>
                        <v-row align="center" justify="center">
                            <v-col xl="6" lg="6" md="6"  sm="7" cols="10" class="d-flex" >
                                <h5 class="label mt-2 mr-13">パスワード</h5>
                                <v-text-field
                                class="password-form"
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
                        <v-row>
                            <v-col class="register-button mb-10" >
                                <v-btn
                                class="py-3 px-15 font-weight-bold white--text"
                                color="black"
                                @click="register"
                                :disabled="isInValidEmail || isInValidPassword || isInValidName || isBlank">
                                新規会員登録
                                </v-btn>
                            </v-col>
                        </v-row>
                        </form>
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
            name:'',
            email:'',
            password:'',
            isLoggedin: '',
            }
        },
    methods:{
        checkLogin(){
            if( this.$store.getters['userAuth/setToken'] ){
                this.isLoggedin = true

                this.$router.push("/")
            }else{
                this.isLoggedin = false
                console.log(1);
            }
        },
        login() {
            axios.post('api/login', {
                    email: this.email,
                    password: this.password
                    })
            .then(res => {
                console.log(res.data);
                this.$store.dispatch('userAuth/setUsers', {name: res.data.user.name, auth: true, token: res.data.user.token});
                this.$router.push("/");
            })
            .catch(error => {
                this.errors = error;
            });
        },
        register(){
        axios.post('api/register', {
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
    },
    mounted(){
        this.checkLogin();
    },
    computed:{
        isInValidName(){
            if(this.name){
                if(this.name.length < 3 ){
                    return true
                }else{
                    return false
                }
            }else{
            }

        },
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
            if(!this.password || !this.email || !this.name){
                return true
            }else{
            }
        }
        }
    }

</script>

<style lang="scss" scoped>
.name-label{
    margin-right:93px;
    white-space: nowrap;
}
.label{
    white-space: nowrap;
}

.name-error{
    color: red;
    font-weight: bold;
}
.email-error{
    color: red;
    font-weight: bold;
}
.password-error{
    color: red;
    font-weight: bold;
}




</style>
