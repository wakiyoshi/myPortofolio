<template>
    <v-container fluid>
        <v-row>
            <v-col lg='1' md='1' sm='1' xs='1'>
                <v-spacer></v-spacer>
            </v-col>
            <v-col md='2' sm='4' xs='4'>
                <router-link to="/">
                    <v-img
                    class="mt-10"
                    src="/img/logo.png"
                    width="220"
                    max-width="240"
                    >
                    </v-img>
                </router-link>
            </v-col>
            <v-col md='1' sm='1'>
                <v-spacer></v-spacer>
            </v-col>
            <v-col md='3' sm='5' xs='5'>
            <div id="searchComponent">
                <form @submit.prevent="search">
                    <v-text-field
                        v-model="keyword.content"
                        class="mt-16"
                        width=""
                        color='black'
                        label="アイテムを検索"
                        prepend-icon='mdi-magnify'
                        @enter="search"
                    ></v-text-field>
                </form>
            </div>
            </v-col>
            <v-col lg="1" md="1" sm="1" xs="1" >
                <v-spacer></v-spacer>
            </v-col>
            <v-col md="2" sm="6" xs="6" v-if="!login" >
                <router-link to="/register" >
                    <v-btn
                        class="subtitle-1 mr-50 px-6 py-6 mt-14 font-weight-bold fontsize"
                        color="blue accent-1"
                        >新規会員登録
                    </v-btn>
                </router-link>
            </v-col>

            <v-col md="1" sm="6" xs="6" v-if="!login">
                <router-link to="/login"  >
                    <v-btn
                        class="subtitle-1 px-6 py-6 mt-14 font-weight-bold"
                        color="orange accent-1"
                        >サインイン
                    </v-btn>
                </router-link>
            </v-col>
            <v-col lg='1' md='1' sm='2' xs='2' v-if="login" >
                <router-link to="/cart" >
                    <div class="hidden-ms-and-down">
                    <v-btn icon color="black" class="mt-16 ">
                        <v-icon>mdi-cart</v-icon>
                    </v-btn>
                    </div>
                </router-link>
            </v-col>
            <v-col lg='1' md='1' sm='2' xs='2' v-if="login" >
                <router-link to="/wishlist" >
                    <v-btn icon color="black" class="mt-16 ">
                        <v-icon>mdi-heart</v-icon>
                    </v-btn>
                </router-link>
            </v-col>
            <v-col lg='1' md='1' sm='2' xs='2'>
                <router-link to="/user-information" v-if="login">
                    <v-btn icon color="black" class="mt-16">
                        <v-icon>mdi-account</v-icon>
                    </v-btn>
                </router-link>
            </v-col>

        </v-row>

    </v-container>
</template>

<script>
export default {
    data() {
        return {
            product: null,
            keyword:{
            content: null,
            },

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

        beforeRouteUpdate(to, from, next){
            this.keyword.context = to.query.search
            next()
        },
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


