<template>
    <v-main>
    <v-row id="site-header" >
        <v-col
        cols="12"
        sm="3">
        <router-link to="/user-home">
            <v-img
            src="/img/logo.png"
            max-width="200">
            </v-img>
        </router-link>
        </v-col>
        <v-col
          cols="12"
          sm="4"
        >
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
        <v-col
        cols='12'
        sm='1'
        >
            <v-spacer></v-spacer>
        </v-col>
        <v-col
        cols="24"
        sm="1">
        <router-link to="/cart">
            <v-btn icon color="black" class="mt-6 ">
                <v-icon>mdi-cart</v-icon>
            </v-btn>
        </router-link>
        </v-col>
        <v-col
        cols="12"
        sm="1"
        >
        <router-link to="/wishlist">
            <v-btn icon color="black" class="mt-6 ">
                <v-icon>mdi-heart</v-icon>
            </v-btn>
        </router-link>
        </v-col>
        <v-col
        cols="12"
        sm="2">
        <router-link to="/user-information">
            <v-btn icon color="black" class="mt-6">
                <v-icon>mdi-account</v-icon>
            </v-btn>
        </router-link>
        <router-link to="/login">
                <v-btn
                    class="pa-6 mt-4 font-weight-bold"
                    color="orange accent-1"
                    >ログインは<br>こちらから
                </v-btn>
        </router-link>

        </v-col>

    </v-row>
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
        methods:{
            search(){
                this.$router.push({name:"plp-search",query:{ search:this.keyword.content}},() => {})
            },

        },
        // watch:{
        //     $route () {
        //         location.reload()
        //     }
        // },
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


