
<template>
    <v-footer
    :height="height"
    color="gray"
    >
        <v-container fluid>
            <v-row >
                <v-col lg="3" md="3" sm="6" cols="12" align="center" justify="center">
                    <h4 class="mt-4">ニュース</h4>
                    <p class="subtitle-2 mt-4">キャンペーン</p>
                    <p class="subtitle-2 "> ニュース</p>
                </v-col>
                <v-col lg="3" md="3" sm="6" cols="12" align="center" justify="center">
                    <h4 class="mt-4">注目商品</h4>
                    <p class="subtitle-2 mt-4">新商品</p>
                    <p class="subtitle-2">人気商品</p>


                </v-col>
                <v-col lg="3" md="3" sm="6" cols="12" align="center" justify="center">
                    <h4 class="mt-4">カテゴリーから探す</h4>
                    <p class="subtitle-2 mt-4">ソファー</p>
                    <p class="subtitle-2">ベッド</p>
                    <p class="subtitle-2">インテリア雑貨</p>
                    <p class="subtitle-2">生活雑貨</p>
                    <p class="subtitle-2">キッチン用品</p>

                </v-col>
                <v-col lg="3" md="3" sm="6" cols="12" align="center" justify="center">
                    <h4 class="mt-4">お問い合わせ</h4>
                    <p class="subtitle-2 mt-4">お問い合わせフォーム</p>
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
            case 'xs': return 750
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
