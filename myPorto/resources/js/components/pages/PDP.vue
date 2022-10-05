<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
        <div v-if='products'>
            <div id="breadcrumb-list">
                <p>前のページ/商品詳細</p>
            </div>
            <div id="container">
                <div id="product-image">
                <v-carousel
                height="700"
                hide-delimiters
                >
                    <v-carousel-item
                        width="50%"
                        v-for="(image,i) in filteredImage"
                        :key="i"
                        :src="'/img/'+ image"
                    >
                    </v-carousel-item>
                </v-carousel>
            </div>
                <h1 id="product-name" >
                    {{products.name}}
                </h1>
                <p id="product-price">通常価格 {{products.price}}円 (税込)</p>
                    <div class="favorite-buttons" >
                        <v-btn color="red" @click="unfavorite(products.id)"
                        v-if="favoriteId.includes(products.id)"
                        class="py-3 px-10 font-weight-bold white--text" >
                        気になる商品から削除
                        </v-btn>

                        <v-btn color="black" @click="favorite(products.id)"
                        v-else
                        class="py-3 px-10 font-weight-bold white--text">
                        気になる商品に追加
                        </v-btn>
                    </div>
                    <div class="cart-buttons" >

                            <v-btn color="red"
                            @click="destroyCart(products.id)"
                            v-if="cartProduct.includes(products.id)"
                            class="py-3 px-10 font-weight-bold white--text" >
                            カートから削除する
                            </v-btn>
                        <router-link to="/cart">
                            <v-btn color="black"
                            @click="addToCart(products.id)"
                            v-if="!cartProduct.includes(products.id)"
                            class="py-3 px-10 font-weight-bold white--text" >
                            カートに追加
                            </v-btn>
                        </router-link>
                    </div>
                <div class="message-button" >
                    <router-link to="/user-message">
                        <v-btn color="black" class="py-3 px-10 font-weight-bold white--text">
                        商品についてのお問い合わせ
                        </v-btn>
                    </router-link>
                </div>
                <div class="purchase-button" >
                    <router-link :to="{ name:'payment-information',params:{payment: products.price}}">
                        <v-btn color="black"
                        class="py-3 px-10 font-weight-bold white--text">
                        購入する
                        </v-btn>
                    </router-link>
                </div>
                <v-divider></v-divider>
                <h2>商品詳細</h2>
                <p>素材  {{products.material}}</p>
                <p>サイズ  {{products.size}}</p>
            <div id="product-information">
                <h1>商品説明</h1>
                <p>{{products.information}}</p>
            </div>
                <div>
                </div>
            </div>
        </div>
        <footer-component/>

    </v-app>
</template>

<script>


    export default {
        checkLogin(){
            if( this.$store.getters['userAuth/setToken']){
                this.isLoggedin = true

            }else{
                this.isLoggedin = false
                this.$router.push("/login")
            }
        },
        data(){
            return{
                products: null,
                images: null,
                filteredImage: null,
                favoriteId: [],
                cartProduct: [],
                isLoggedin: null,
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
            getFavorite() {
                axios.get('/api/hasfavorites',
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res => {
                    this.favoriteId = res.data
                    console.log(this.favoriteId)

                }).catch(function(error){
                    console.log(error);
                });
            },
            favorite(id) {
                axios.post('/api/favorites/'+ id ,
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                }
                )
                .then(res => {
                    console.log(res)
                    this.favoriteId.push(id)

                }).catch(function(error) {
                    console.log(error);
                });
            },
            unfavorite(id) {
                axios.post('/api/unfavorites/'+ id,
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res => {
                    console.log(res.data)
                    const index = this.favoriteId.indexOf(id)
                    this.favoriteId.splice(index, 1);
                }).catch(function(error){
                    console.log(error);
                });
                },
            addToCart(id) {
                axios.post('/api/cart/store/' + id,                 {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res =>{
                console.log(res)
                this.cartProduct.push(id)
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            destroyCart(id) {
                axios.post('/api/cart/destroy/' + id,                 {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res =>{
                    console.log(res.data)
                    const index = this.cartProduct.indexOf(id)
                    this.cartProduct.splice(index, 1);
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            getCart() {
                axios.get('/api/cart',
                {
                    headers: {
                    Authorization: `Bearer ${this.$store.getters['userAuth/setToken']}`,
                }
                })
                .then(res =>{
                    console.log(res.data)
                    this.cartProduct = res.data
                })
                .catch(error=>{
                    console.log(error)
                })
            },


        },
        mounted(){
            axios.post('/api/product/'+ this.$route.params.id )
            .then(res => {
                console.log(this.$route.params.id)
                this.products = res.data
                this.images = [this.products.image1,this.products.image2,this.products.image3,
                this.products.image4,this.products.image5,this.products.image6,]
                this.filteredImage = this.images.filter((e)=> e !== null)
            })
            .catch(error=>{
                console.log(error)
            });
        },
        created(){
            this.checkLogin();
            if(this.isLoggedin){
                this.getFavorite();
            }

            if(this.isLoggedin){
            this.getCart();
            }
        }




    }
</script>

<style scoped>

a {
    text-decoration: none;
}
#product-list {
    display: flex;
    flex-wrap: wrap;
}
#product-image{
    width: 80%;
    align-items: center;
}
</style>
