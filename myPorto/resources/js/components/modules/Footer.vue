
<template>
    <v-footer
    height="300px"
    color="gray"
    >
        <v-container >
            <div style="display:flex;  align-items;">
            <div style="margin: 0 auto;" >
                <h3>ニュース</h3>
                <ul style="list-style:none">
                    <li>
                        <router-link to="/">キャンペーン</router-link>
                    </li>
                    <li>
                        <router-link to="/">イベント</router-link>
                    </li>
                </ul>
            </div>
            <div style="margin: 0 auto;">
                <h3>注目カテゴリー</h3>
                <ul style="list-style:none">
                    <li>
                        <router-link to="/">新商品</router-link>
                    </li>
                    <li>
                        <router-link to="/">人気商品</router-link>
                    </li>
                </ul>

            </div>
            <div style="margin: 0 auto;">
                <h3>カテゴリーから探す</h3>
                <ul style="list-style:none; color:black;  ">
                    <li>
                        <router-link to="/">ソファー</router-link>
                    </li>
                    <li>
                        <router-link to="/">ベッド</router-link>
                    </li>
                    <li>
                        <router-link to="/">インテリア雑貨</router-link>
                    </li>
                    <li>
                        <router-link to="/">生活雑貨</router-link>
                    </li>
                    <li>
                        <router-link to="/">キッチン用品</router-link>
                    </li>
                    <li>
                        <router-link to="/">チェア・椅子</router-link>
                    </li>

                </ul>

            </div>
            <div style="margin:  0 auto;">
                <h3>お問い合わせ</h3>
                <ul style="list-style:none; text-decoration: none; color: inherit;">
                    <li>
                        <router-link to="/">お問い合わせフォーム</router-link>
                    </li>
                </ul>
            </div>
            </div>
                <div style="text-align:center; margin-top:50px;">
            <p class="text-body-2" >DESIGN BY Wakikawa Yoshihiro - © 2022. ALL RIGHTS RESERVED.</p>
        </div>
        </v-container>




    </v-footer>

</template>


<script>
    export default {
    }
</script>

<style lang="scss" scoped>
.text-body-2{

}


</style>
