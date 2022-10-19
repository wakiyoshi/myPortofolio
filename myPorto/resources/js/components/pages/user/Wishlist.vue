<template>
    <v-app>

        <campaign-component/>
        <user-header-component  :login="isLoggedin"/>
        <menu-component/>
        <Breadcrumbs />
            <div id="container">
                <div id="product-list" >
                <tr v-for="(product,index) in products" :key="index">
                    <td>
                        <router-link :to="{ name:'pdp',params:{id: product.id}}">
                        <v-img
                        max-width="200px"
                        :src="'/img/'+ product.image1"
                        >
                        </v-img>
                        </router-link>
                        <div class="product-name">{{product.name}}</div>
                        <div>{{product.price}}円 (税込)</div>
                        <router-link :to="{ name:'payment-information',query:{id: product.id,payment: product.price,name: product.name}}">
                        <v-btn color="black" class="py-3 px-10 font-weight-bold white--text"
                        >
                        購入する</v-btn>
                        </router-link>
                        <v-btn color="white"  @click="unfavorite(product.id,index)" class="font-weight-bold black--text">
                        削除 x</v-btn>
                    </td>
               </tr>
                <v-pagination
                    v-model="page"
                    :length="length"
                    >
                </v-pagination>


                </div>
            </div>
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
#product-list {
    display: flex;
    flex-wrap: wrap;
}
</style>


