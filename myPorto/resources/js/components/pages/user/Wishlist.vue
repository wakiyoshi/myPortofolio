<template>
    <v-app>
        <campaign-component/>
        <user-header-component  :login="isLoggedin"/>
        <menu-component/>
        <Breadcrumbs />
            <v-container fluid>
                <v-row>
                    <v-col>
                        <h2 align="center" justify="center">
                            お気に入り
                        </h2>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                <v-col class="mt-10 ml-10 " v-for="(product,index) in products" :key="index" align="center" justify="center">

                        <router-link :to="{ name:'pdp',params:{id: product.id}}">
                        <v-img
                            max-width="230px"
                            max-height="230px"
                            width="230px"
                            height="230px"
                            :src="product.image1"
                        >
                        </v-img>
                        </router-link>
                        <h5 class="product-name mt-2">{{product.name}}</h5>
                        <h6 class="mb-2">{{product.price}}円 (税込)</h6>
                        <router-link :to="{ name:'payment-information',query:{id: product.id,payment: product.price,name: product.name}}">
                        <v-btn color="black" class="py-3 px-10 font-weight-bold white--text"
                        >
                        <h5>購入する</h5></v-btn>
                        </router-link>
                        <v-btn color="white"  @click="unfavorite(product.id,index)" class="font-weight-bold black--text">
                        <h5>削除 x</h5> </v-btn>

                </v-col>

                </v-row>
                <v-row class="mt-16 mb-16" align="center" justify="center">
                        <v-pagination
                            v-model="page"
                            :length="length"
                            >
                        </v-pagination>
                </v-row>
            </v-container>
        <footer-component/>
    </v-app>
</template>
<script>


    export default {

        data(){
            return{
                products: null,
                page:1,
                length: 0,
                favoriteId: null,
                isLoggedin: null,
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

            getFavoriteProducts() {
                axios.get('/api/favorites/product',
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res => {
                    console.log(res.data)
                    this.products = res.data
                }).catch(function(error){
                    console.log(error);
                });
            },
            unfavorite(id,index) {
                axios.post('/api/unfavorites/'+ id,
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res => {
                    console.log(res.data)
                    this.products.splice(index,1);
                }).catch(function(error){
                    console.log(error);
                });
                },
            },

            mounted() {
            this.getFavoriteProducts();
            this.checkLogin();
            }
    }




</script>

<style scoped>

.product-name{
    color:black;
}
a{
    text-decoration: none;

}
p{
    font-weight: bold;
}
#product-list {
    display: flex;
    flex-wrap: wrap;
}
</style>


