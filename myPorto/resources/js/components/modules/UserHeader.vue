<template>
    <v-container fluid >
        <v-row >
            <v-col lg='1' md='1' sm='1' cols='1'>
                <v-spacer></v-spacer>
            </v-col>

            <v-col  class="mt-12" md='2' sm='8' cols='8'>
                <router-link to="/">
                    <v-img
                    class=""
                    src="https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/es4r9noZdlTkv4A9HUZzI1DiJxHaGKnvSGSqkbyQ.png"
                    :width="width"
                    max-width="200"
                    >
                    </v-img>
                </router-link>
            </v-col>

            <v-col class="hidden-md-and-up mt-4 mr-10" md='2' sm='1' cols='1' align="center" justify="center">
                <v-app-bar-nav-icon class="nav-icon .d-block .d-sm-none" @click="drawer = true" ></v-app-bar-nav-icon>
                <v-navigation-drawer class="drawer"
                            height="150px"
                            width="60%"
                            v-model="drawer"
                            fixed
                            floating
                            rounded
                            app
                            right
                >
                <v-list dense rounded >

                        <v-list-item color="white">
                            <v-row align="center" justify="center" width="90%">
                                    <form @submit.prevent="search">
                                        <v-text-field
                                            v-if="drawer"
                                            class="mt-6"
                                            v-model="keyword.content"
                                            dense
                                            label="アイテムを検索"
                                            prepend-icon='mdi-magnify'
                                            @enter="search"
                                        ></v-text-field>
                                    </form>
                            </v-row>
                        </v-list-item>

                        <v-list-item v-if="login">
                                <v-row align="center" justify="center">
                                        <v-col  v-if="drawer" >
                                             <router-link to="/cart">
                                                <h5 class="sign-in-font">カートを確認</h5>
                                             </router-link>
                                        </v-col>
                                </v-row>
                        </v-list-item>

                        <v-list-item v-if="login">
                                <v-row align="center" justify="center">
                                    <v-col  v-if="drawer" >
                                        <router-link to="/wishlist">
                                            <h5 class="sign-in-font">お気に入り</h5>
                                        </router-link>
                                    </v-col>
                                </v-row>
                        </v-list-item>

                        <v-list-item v-if="login">
                                <v-row align="center" justify="center">
                                    <v-col  v-if="drawer" >
                                        <router-link to="/user-information">
                                            <h5 class="sign-in-font">会員情報確認・変更</h5>
                                        </router-link>
                                    </v-col>
                                </v-row>
                        </v-list-item>

                        <v-list-item v-if="!login">
                            <v-row align="center" justify="center" >
                                <v-col v-if="drawer">
                                    <router-link to="/login">
                                        <h5>サインイン</h5>
                                    </router-link>
                                </v-col>
                            </v-row>
                        </v-list-item>
                        <v-list-item v-if="!login">

                                <v-row align="center" justify="center" >
                                    <v-col v-if="drawer" >
                                        <router-link to="/register">
                                            <h5>新規会員登録</h5>
                                        </router-link>
                                    </v-col>
                                </v-row>

                        </v-list-item>
                </v-list>
                </v-navigation-drawer>
            </v-col>

            <v-col md='1' sm='3' cols='3'>
                <v-spacer></v-spacer>
            </v-col>
            <v-col class="search-field hidden-sm-and-down" md='3' sm='7' cols='7' align="center" justify="center" >
                <form @submit.prevent="search">
                    <v-text-field
                        v-model="keyword.content"
                        dense
                        color='black'
                        label="アイテムを検索"
                        prepend-icon='mdi-magnify'
                        @enter="search"
                    ></v-text-field>
                </form>
            </v-col>
            <v-col lg="1" md="1" sm="1" cols="1" >
                <v-spacer></v-spacer>
            </v-col>
            <v-col class="hidden-sm-and-down" md="2" sm="6" xs="6" v-if="!login" >
                <router-link to="/register" >
                    <v-btn
                        class="px-6 py-4 mt-16  fontsize"
                        color="blue lighten-3"
                        >
                        <h4>新規会員登録</h4>
                    </v-btn>
                </router-link>
            </v-col>

            <v-col class="hidden-sm-and-down" md="1" sm="6" xs="6" v-if="!login">
                <router-link to="/login"  >
                    <v-btn
                        class=" px-4 py-2 mt-16 "
                        color="orange accent-1"
                        >
                        <h4>サインイン</h4>
                    </v-btn>
                </router-link>
            </v-col>
            <v-col class="mt-16 login-contents hidden-sm-and-down" lg='1' md='1' sm='2' xs='2' v-if="login" >
                <router-link to="/cart" >
                    <div>
                    <v-btn icon color="black" >
                        <v-icon>mdi-cart</v-icon>
                    </v-btn>
                    </div>
                </router-link>
            </v-col>
            <v-col class="mt-16 hidden-sm-and-down" lg='1' md='1' sm='2' xs='2' v-if="login" >
                <router-link to="/wishlist" >
                    <v-btn icon color="black" class="login-contents">
                        <v-icon>mdi-heart</v-icon>
                    </v-btn>
                </router-link>
            </v-col>
            <v-col class="mt-16 hidden-sm-and-down" lg='1' md='1' sm='2' xs='2'>
                <router-link to="/user-information" v-if="login">
                    <v-btn icon color="black" >
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
            drawer: false,


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

    computed:{
        width () {
            switch (this.$vuetify.breakpoint.name) {
            case 'xs': return 150
            case 'sm': return 150
            case 'md': return 170
            case 'lg': return 170
            case 'xl': return 170
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

.search-field{
    margin-top: 70px;
}
.nav-icon{
    margin-top: 40px;
    margin-right: 10px;
    width: 50px;
    height: 50px;

}
.drawer{
    margin-top: 100px;
    margin-right: 20vw;
    margin-left: 20vw;
    border-radius: 10px;
    transition: all 1ms ease-in;

.login-contents{
    margin-top: 200px;
}


}
.sign-in-item{
    align-items: center;



}
.sign-in-text{
    text-align: center;
    border-radius: 30px;
    width: 60%;
}
.sign-in-font{
    font-weight: 900;
    margin: 10px;
}
.register-text{
    text-align: center;
    transition: all 1ms ease-in
}
.register-font{
    font-weight: 900;
    margin: 10px;
}

a{
    text-decoration: none;
}


</style>


