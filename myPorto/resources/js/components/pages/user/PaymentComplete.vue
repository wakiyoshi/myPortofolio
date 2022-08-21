<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <v-main>
            <div id="container">
                <div class="current-page">
                    <v-btn
                        dark
                        color="grey">情報入力</v-btn>
                        <p>>>></p>
                        <v-btn
                        dark
                        color="grey ">情報確認</v-btn>
                        <p>>>></p>
                        <v-btn
                        dark
                        color="black">注文完了</v-btn>
                </div>
                <div class="complete-img">
                    <v-img
                    src="/img/complete.png"
                    max-width="200">
                    </v-img>
                </div>
                <div>
                    <p>情報を送信し、正常に取引が完了いたしました。<br>
                        ご購入ありがとうございました。<br>
                        登録メールアドレスに決済内容を送信いたしましたので、<br>
                        ご確認お願いいたします。</p>
                </div>



            </div>

        </v-main>
    </v-app>

</template>

<script>
    export default {

        data(){
            return{

            }
        },
        method:{

        },
        mounted(){
            axios.get('/api/product')
            .then(response => {
                this.products = response.data;
            })
            .catch(error=>{
                console.log(error)
            });
        },


    }
</script>

<style scoped>
#container{
    text-align: center;

}
.information-form{
    align-items: center;

}

#product-list {
    display: flex;
    flex-wrap: wrap;
}
</style>
