
<template>
    <v-footer
    :height="height"
    color="gray"
    >
        <v-container fluid>
            <v-row >
                <v-col lg="3" md="3" sm="6" cols="12" align="center" justify="center">
                    <h3>ニュース</h3>
                    <p class="mt-4">キャンペーン</p>
                    <p>ニュース</p>
                </v-col>
                <v-col lg="3" md="3" sm="6" cols="12" align="center" justify="center">
                    <h3>注目商品</h3>
                    <p class="mt-4">新商品</p>
                    <p>人気商品</p>


                </v-col>
                <v-col lg="3" md="3" sm="6" cols="12" align="center" justify="center">
                    <h3>カテゴリーから探す</h3>
                    <p class="mt-4">ソファー</p>
                    <p>ベッド</p>
                    <p>インテリア雑貨</p>
                    <p>生活雑貨</p>
                    <p>キッチン用品</p>

                </v-col>
                <v-col lg="3" md="3" sm="6" cols="12" align="center" justify="center">
                    <h3>お問い合わせ</h3>
                    <p class="mt-4">お問い合わせフォーム</p>
                </v-col>
            </v-row>
            <v-row >
                <v-col  align="center" justify="center">
                    <h5>©︎ Interigent Online Interior Store Designed by Yoshihiro Wakikawa </h5>
                </v-col>
            </v-row>
        </v-container>
    </v-footer>

</template>


<script>
    export default {


    computed:{
        height () {
            switch (this.$vuetify.breakpoint.name) {
            case 'xs': return 480
            case 'sm': return 480
            case 'md': return 360
            case 'lg': return 360
            case 'xl': return 380
            }
      },
    }

    }
</script>

<style lang="scss" scoped>
a:link, a:visited, a:hover, a:active{
    color:black;
    text-decoration: none;
}


</style>
