<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <v-container fluid>
            <v-row class="mt-6 hidden-sm-and-down" align="center" justify="center" >
                <v-btn
                    class="px-10 py-6 mr-4 white--text"
                    color="grey lighten-1"><h2 class="step-titles">Step1 情報入力</h2></v-btn>
                <h2 class="arrow-signs">>>></h2>
                <v-btn
                class="px-10 py-6 mr-4 ml-4 white--text"
                color="grey lighten-1"><h2 class="step-titles">Step2 情報確認</h2></v-btn>
                <h2 class="arrow-signs">>>></h2>
                <v-btn
                class="px-10 py-6 mr-4 ml-4 white--text"
                color="green accent-3"><h2 class="step-titles">Step3 注文完了</h2></v-btn>
            </v-row>
            <v-row class="mt-10" align="center" justify="center">
                <v-col align="center" justify="center">
                    <h3>情報を送信し、正常に取引が完了いたしました。<br>
                      登録メールアドレスに決済内容を送信いたしました。<br>
                      </h3>


                </v-col>
            </v-row>
            <v-row class="mt-6">
                <v-col align="center" justify="center">
                    <v-img
                    src="/img/complete.png"
                    width="30%">
                    </v-img>
                </v-col>
            </v-row>
            <v-row >
                <v-col align="center" justify="center">
                    <h2 class="">
                        Interigent をご利用いただきありがとうございました。
                    </h2>
                </v-col>
            </v-row>


        </v-container>
    </v-app>

</template>

<script>
    export default {

        data(){
            return{
                isLoggedin: null
            }
        },
        methods:{
            checkLogin(){
                    if( this.$store.getters['userAuth/setToken'] ){
                        this.isLoggedin = true
                        console.log(sessionStorage.getItem('User'));


                    }else if(!sessionStorage.getItem('User') && this.$store.getters['userAuth/setToken']){
                        this.isLoggedin = false
                        console.log(sessionStorage.getItem('User'));
                        this.$router.push('/login')

                    }else{
                        this.isLoggedin = false
                        console.log(sessionStorage.getItem('User'));
                        this.$router.push('/login')
                    }
            },
        },
        mounted(){
            this.checkLogin()
        },


    }
</script>

<style scoped>

.arrow-signs{
    color: #EEEEEE;
}
.step-titles{
text-transform:capitalize;
}

</style>
