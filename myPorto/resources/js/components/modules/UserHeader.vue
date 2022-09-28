<template>
    <v-main>
        <v-container>
    <v-row id="site-header" >
        <v-col >
        <router-link to="/">
            <v-img
            src="/img/logo.png"
            max-width="200">
            </v-img>
        </router-link>
        </v-col>
        <v-col cols="3" >
        <div id="searchComponent">
            <form @submit.prevent="search">
                <v-text-field
                    v-model="keyword.content"
                    class="mt-8"
                    color='black'
                    dense
                    label="アイテムを検索"
                    prepend-icon='mdi-magnify'
                    @enter="search"
                ></v-text-field>
            </form>
        </div>
        </v-col>
        <v-col cols="1" >
            <v-spacer></v-spacer>
        </v-col>
        <v-col cols="1.5"  v-if="login">
        <router-link to="/cart" >
            <v-btn icon color="black" class="mt-6 ">
                <v-icon>mdi-cart</v-icon>
            </v-btn>
        </router-link>
        </v-col>
        <v-col cols="1.5" >
        <router-link to="/wishlist" v-if="login">
            <v-btn icon color="black" class="mt-6 ">
                <v-icon>mdi-heart</v-icon>
            </v-btn>
        </router-link>
        <router-link to="/register" v-if="!login">
            <v-btn
                class="pa-6 mt-4 font-weight-bold"
                color="blue accent-1"

                >新規会員登録
            </v-btn>
        <router-link to="/login" v-if="!login" >
            <v-btn
                class="pa-6 mt-4 font-weight-bold"
                color="orange accent-1"
                >ログインは<br>こちらから
            </v-btn>
        </router-link>
        </router-link>
        </v-col>
        <v-col cols="1.5">
        <router-link to="/user-information" v-if="login">
            <v-btn icon color="black" class="mt-6">
                <v-icon>mdi-account</v-icon>
            </v-btn>
        </router-link>
        </v-col>

    </v-row>
        </v-container>
    </v-main>
</template>

<script>
    export default {
        data() {
            return {
                keyword:{
                content: null,
                },
                product: null,
            }
        },
        props:
            {
            'login': {
                type: Boolean,
                default: false,
            },
            },

        methods:{
            search(){
                this.$router.push({name:"plp-search",query:{ search:this.keyword.content}},() => {})
            },

        },
        mounted(){
            console.log(this.login)

        },
        beforeRouteUpdate(to, from, next){
            this.keyword.context = to.query.search
            next()
        }



        }


</script>

<style lang="scss" scoped>
#site-header{
    margin:40 40 0 40;
}
a{
    text-decoration: none;
}
</style>


