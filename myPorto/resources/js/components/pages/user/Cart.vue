<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
        <Breadcrumbs />
            <div id="container">

                <div class="register-content" v-if="!isLoggedin">
                    <p>ログイン、新規会登録をして、カートに商品を追加</p>
                    <router-link to="/register">
                        <v-btn color="black" class="white--text">
                            新規会員登録
                        </v-btn>
                    </router-link>
                    <router-link to="/login">
                        <v-btn color="orange" class="white--text">
                            ログイン
                        </v-btn>
                    </router-link>
                </div>
                <div class="product-list" >
                    <table>
                        <tr v-for="(product,index) in products" :key="index">
                            <td>
                                <router-link :to="{ name:'pdp',params:{id: product.id}}">
                                    <v-img
                                    max-width="200px"
                                    :src="'/img/'+ product.image1"
                                    >
                                    </v-img>
                                    </router-link>
                                        <p class="product-name">{{product.name}}</p>
                                        <p>{{product.price}}円 (税込)</p>
                                    <router-link :to="{ name:'payment-information',query:{payment: product.price , name: product.name}}">
                                        <v-btn color="black" class="py-3 px-10 font-weight-bold white--text">
                                        購入する</v-btn>
                                    </router-link>
                                <div class="product-quantity">
                                    <v-select
                                    :items="item"
                                    v-model="selectedQuantity[index]"
                                    label="1"
                                    @click="getQuantity(product.quantity)"
                                    @input="calculatePrice($event)"
                                    solo
                                    >
                                    <option v-for="(n,index) in product.quantity" :value="n" :key="index">

                                    </option>
                                    </v-select>
                                </div>
                                <v-btn color="white"  @click="destroyCart(product.id,index)" class="font-weight-bold black--text">
                                削除 x</v-btn>
                            </td>
                        </tr>
                    </table>
                <div class="payment-description" v-if="productsPrice">
                    <h1>カート合計金額</h1>
                    <div class="order-total-price">
                        <p>注文合計金額</p>
                        <p class="total-price" v-if="productsPrice"> {{ (productsPrice + taxPrice).toLocaleString() }} 円</p>
                        <v-divider></v-divider>
                    </div>
                    <div class="product-total-price" >
                        <p>商品合計金額 (税込)</p>
                        <p v-if="productsPrice">{{ productsPrice.toLocaleString() }} 円</p>
                        <v-divider></v-divider>
                    </div>
                    <div class="tax-total-price">
                        <p>送料（税込）</p>
                        <p v-if="taxPrice">{{ taxPrice }} 円</p>
                        <v-divider></v-divider>
                    </div>

                <router-link :to="{ name:'payment-information',query: { payment: productsPrice + taxPrice }}" >
                    <v-btn color="black" class="py-3 px-10 font-weight-bold white--text">
                        購入手続きに進む</v-btn>
                </router-link>

                <router-link to="/plp">
                    <v-btn color="white" class="py-3 px-10 font-weight-bold black--text">
                        商品を追加する</v-btn>
                </router-link>
                <v-pagination
                    v-model="page"
                    :length="length"
                    >
                </v-pagination>
                </div>
            </div>
        </div>
        <footer-component/>
    </v-app>
</template>
<script>


    export default {

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
                this.getCartProducts();
            },
            mounted(){

            }


    }




</script>

<style scoped>

a{
    text-decoration: none;
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
    background-color: lightgray;
}




</style>


