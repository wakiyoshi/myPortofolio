<template>

        <v-main style>
            <div id="category-menu" >
                <p>
                    <router-link to="/">ソファー </router-link>
                </p>
                <p>/</p>
                <p>
                    <router-link to="/">チェア・椅子</router-link>
                </p>
                <p>/</p>
                <p>
                    <router-link to="/">インテリア雑貨</router-link>
                </p>
                <p>/</p>
                <p>
                    <router-link to="/">生活雑貨</router-link>
                </p>
                <p>/</p>
                <p>
                    <router-link to="/">収納家具</router-link>
                </p>
                <p>/</p>
                <p>
                    <router-link to="/">ベッド</router-link>
                </p>
                <p>/</p>
                <p>
                    <router-link to="/">時計</router-link>
                </p>
                <p>/</p>
                <p>
                    <router-link to="/">キッチン用品</router-link>
                </p>
                <p>/</p>
                <p>
                    <router-link to="/">ファブリック・クッション</router-link>
                </p>
            </div>

        </v-main>



</template>


<script>
    export default {
    }
</script>

<style lang="scss" scoped>


#category-menu{
    display:flex;
    list-style:none;
    font-size:22px;
    margin-top: 0px;
    margin-left: 80px;

}

p{
    text-decoration: none;
    font-size: 22px;
    color:black;
    margin: 10px;
}



</style>

