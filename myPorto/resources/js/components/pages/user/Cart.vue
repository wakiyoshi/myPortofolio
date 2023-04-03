<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
        <Breadcrumbs />
        <v-container fluid>
            <v-row class="register-content" v-if="!isLoggedin" >
                <v-col align="center" justify="center">
                    <h3>ログイン、新規会登録をして、カートに商品を追加しましょう</h3>
                    <v-col align="center" justify="center" class="mt-10 mb-16">
                        <v-col >
                            <v-btn color="blue lighten-3" class="mr-10 py-6 px-12 ">
                                <router-link to="/register">
                                    <h3>
                                        新規会員登録
                                    </h3>
                                </router-link>
                            </v-btn>
                            <router-link to="/login">
                                <v-btn color="orange accent-1" class="py-6 px-16 ">

                                        <h3>
                                    ログイン
                                        </h3>

                                </v-btn>
                            </router-link>
                        </v-col>
                    </v-col>

                </v-col>
            </v-row>
            <v-row class="page-wrapper">
                <v-col lg="6" md="6" sm="12" cols="12">
                    <v-row class="cart-container" v-for="(product,index) in products" :key="index">
                        <v-row>
                            <v-col class="" lg="6" md="12" sm="12" cols="12" align="center" justify="center">
                                <router-link :to="{ name:'pdp',params:{id: product.id}}">
                                    <v-img
                                    width="250px"
                                    min-width="200px"
                                    :src="product.image1"
                                    >
                                    </v-img>
                                </router-link>
                            <h4 class="product-name">{{product.name}}</h4>
                            <h5>{{product.price}}円 (税込)</h5>
                            </v-col>
                        <v-col class="" align="center" justify="center">
                            <v-col lg="5" md="5" sm="5" cols="5">
                            <v-select class=""
                            :items="item"
                            v-model="selectedQuantity[index]"
                            label="1"
                            @click="getQuantity(product.quantity)"
                            @input="calculatePrice($event)"
                            solo
                            dense
                            >
                            <option v-for="(n,index) in product.quantity" :value="n" :key="index">
                            </option>
                            </v-select>
                        </v-col>
                        <router-link :to="{ name:'payment-information',query:{payment: product.price , name: product.name}}">
                            <v-btn color="black" class="py-3 px-10 font-weight-bold white--text">
                            この商品を購入する</v-btn>
                        </router-link>
                    <v-col>
                        <v-btn color="white"  @click="destroyCart(product.id,index)" class="font-weight-bold black--text">
                        削除 x</v-btn>
                    </v-col>
                    </v-col>
                    </v-row>
                </v-row>
            </v-col>
            <v-col lg="1" md="1" sm="1" cols="1">
                <v-spacer ></v-spacer>
            </v-col>
            <v-col class="" lg="4" md="4" sm="12" cols="12" v-if="productsPrice" align="center" justify="center" >
                <v-card class="payment-description pt-6" color="grey lighten-3">

                <h3 class="">カート合計金額(税込)</h3>
                <h3 class="total-price mt-2 mb-2" v-if="productsPrice"> {{ (productsPrice + taxPrice).toLocaleString() }} 円</h3>
                <v-divider class="" width="80%" ></v-divider>
                <h4 class="mt-2">商品合計金額</h4>
                <h4 class="mt-2" v-if="productsPrice">{{ productsPrice.toLocaleString() }} 円</h4>
                <v-divider class="mt-2" width="80%"></v-divider>
                    <h4 class="mt-2">送料（税込）</h4>
                    <h4  class="" v-if="taxPrice">{{ taxPrice }} 円</h4>
                    <v-divider class="mt-2 mb-2" width="80%"></v-divider>
                <v-col>
                    <v-btn color="orange accent-1" class="cart-button mt-2 py-6 px-16 font-weight-bold black--text">
                        <router-link :to="{ name:'payment-information',query: { payment: productsPrice + taxPrice }}" >
                        <h4>購入手続きに進む</h4>
                        </router-link>
                    </v-btn>
                </v-col>
                <v-col>
                    <v-btn color="white" class="mt-2 mb-2 py-3 px-12 font-weight-bold black--text">
                        <router-link to="/plp">
                            商品を追加する
                        </router-link>
                    </v-btn>
                </v-col>
                </v-card>
            </v-col>
            </v-row>

            <v-pagination
            v-if="isLoggedin"
                class="mt-16 mb-10"
                v-model="page"
                :length="length"
                >
            </v-pagination>
        </v-container>
        <footer-component/>
    </v-app>
</template>
<script>
import Footer from '../../modules/Footer.vue'


    export default {
  components: { Footer },

        data(){
            return{
                products: [],
                item: [],
                productsPrice: 0,
                taxPrice: 550,
                changedPrice: 0,
                page:1,
                length: 0,
                selectedQuantity: [],
                eventQuantity: null
            }
        },
        methods:{
            checkLogin(){
                if( this.$store.getters['userAuth/setToken']){
                    this.isLoggedin = true
                }else{
                    this.isLoggedin = false
                }
            },
            getCartProducts() {
                axios.get('/api/cart/product',
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res => {
                    console.log(res.data)
                        this.products = res.data
                    if(this.products.length !== 0){
                        this.calculatePrice()
                    }else{

                    }

                }).catch(function(error){
                    console.log(error);
                });
            },
            calculatePrice(){

                if(this.selectedQuantity.length === 0){
                    console.log("loop");
                for(let i = 0; i< this.products.length; i++){
                    this.selectedQuantity.push(1)
                    this.productsPrice += this.products[i].price
                    }
                }else{
                    this.productsPrice = 0
                    this.selectedQuantity.forEach((value,index) => {
                    this.productsPrice += this.products[index].price*value
                    })
                }

            },
            destroyCart(id,index) {
                axios.post('/api/cart/destroy/'+ id,
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res => {
                    console.log(res.data)
                    this.products.splice(index,1);
                    this.productsPrice = 0
                    this.getCartProducts();
                }).catch(function(error){
                    console.log(error);
                });
                },
            getQuantity(quantity){
                this.quantity = [];
                for (let i= 1; i<= quantity; i++){
                    this.item.push(i)
                }
            },
            },
            created(){
                this.checkLogin();
                if(this.isLoggedin){
                    this.getCartProducts();
                }
            },
            mounted(){

            }


    }




</script>

<style scoped>
p{
    font-weight: bold;
}
a:link, a:visited, a:hover, a:active{
    text-decoration: none;
    color: black;
}
.product-name{
    color:black;

}

.product-list {
    display: flex;
    flex-wrap: wrap;
}
.total-price{
    color: red;
}
.payment-description{
    background-color:#EEEEEE;
    border-radius: 15px;
    max-height: 600px;
}
.payment-receipt{
    background-color: white;
    width: 95%;
    border-radius: 15px;
}





</style>


