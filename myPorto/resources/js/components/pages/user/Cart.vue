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
                            <router-link :to="{ name:'payment-information',params:{payment: product.price , name: product.name}}">
                                <v-btn color="black" class="py-3 px-10 font-weight-bold white--text">
                                購入する</v-btn>
                            </router-link>
                        <div class="product-quantity">
                            <v-select
                            :items="item"
                            label="1"
                            @click="getQuantity(product.quantity)"
                            @input="calculatePrice($event,product.id)"
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
                <div class="payment-description" v-if="productsPrice">
                    <h1>合計金額</h1>
                    <div class="order-total-price">
                        <p>注文合計金額</p>
                        <p class="total-price" v-if="productsPrice"> {{ paymentPrice.toLocaleString() }} 円</p>
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
                paymentPrice: 0,
                changedPrice: 0,
                page:1,
                length: 0,
                selectedQuantity: null,
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
                    this.calculatePrice(1,1)

                }).catch(function(error){
                    console.log(error);
                });
            },
            calculatePrice(e,id){
                console.log(e);
                this.paymentPrice= 0
                this.productsPrice = 0

                const price = this.products.map(item => item.price)
                this.productsPrice += price.reduce((a,b)=> {return a + b});
                this.paymentPrice += this.productsPrice + this.taxPrice


                if(e !== 1 && e !== null){
                console.log("changed");
                this.eventQuantity = 0
                const targetProduct = this.products.find( (v) => v.id === id);
                this.eventQuantity = e
                this.paymentPrice += targetProduct.price*(e-1)
                console.log(this.paymentPrice);
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
            mounted() {
                if(this.isLoggedin){
                this.getCartProducts();
                }

            },
            created(){
                this.checkLogin();
            },

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


