<template>
    <v-app>
        <v-main>
        <campaign-component/>
        <user-header-component/>
        <menu-component/>
        <Breadcrumbs />
            <div id="container">
                <div class="product-list" >
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
                        <router-link :to="{ name:'payment-information',params:{payment: product.price}}">
                        <v-btn color="black" class="py-3 px-10 font-weight-bold white--text">
                        購入する</v-btn>
                        </router-link>
                        <v-btn color="white"  @click="destroyCart(product.id,index)" class="font-weight-bold black--text">
                        削除 x</v-btn>
                    </td>
               </tr>
                <div class="payment-description" v-if="totalPrice">
                    <h1>合計金額</h1>
                    <div class="order-total-price">
                        <p>注文合計金額</p>
                        <p class="total-price" v-if="totalPrice"> {{ (totalPrice + taxPrice).toLocaleString() }} 円</p>
                        <v-divider></v-divider>
                    </div>
                    <div class="product-total-price" >
                        <p>商品合計金額 (税込)</p>
                        <p v-if="totalPrice">{{ totalPrice.toLocaleString() }} 円</p>
                        <v-divider></v-divider>
                    </div>
                    <div class="tax-total-price">
                        <p>送料（税込）</p>
                        <p v-if="taxPrice">{{ taxPrice }} 円</p>
                        <v-divider></v-divider>
                    </div>

                <router-link :to="{ name:'payment-information',params: { payment: paymentPrice}}" >
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
        </v-main>
    </v-app>
</template>
<script>


    export default {

        data(){
            return{
                products: [],
                page:1,
                length: 0,
                totalPrice: null,
                taxPrice: null,
                paymentPrice: null,

            }
        },
        methods:{
            userInfo() {
                axios.get('/api/user/auth',
                {
                headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then (res => {
                if( !this.$store.getters['userAuth/setToken'])

                {
                    this.$router.push("/login")
                }
                })
                .catch((err) => {
                    console.log(err)
                    this.$router.push("/login")
                })
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
                    const price = this.products.map(item => item.price)
                    this.totalPrice = price.reduce((a,b)=> {return a + b});
                    this.taxPrice = 550
                    this.paymentPrice = this.totalPrice + this.taxPrice
                }).catch(function(error){
                    console.log(error);
                });
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
                    this.getCartProducts();
                }).catch(function(error){
                    console.log(error);
                });
                },
            },
            mounted() {
            this.getCartProducts();
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


