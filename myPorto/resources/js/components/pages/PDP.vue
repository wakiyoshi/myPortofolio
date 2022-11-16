<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
        <Breadcrumbs />
            <v-row  center="align" justify="center" v-if="products.length !== 0">
                <v-col class="mt-6 ml-4" lg="6" md="6" sm="12" cols="12">
                    <v-carousel
                    hide-delimiters
                    align="center" justify="center">
                        <v-carousel-item
                            width="80%"
                            height="80%"
                            v-for="(image,i) in filteredImage"
                            :key="i"
                            :src="'/img/'+ image"
                        >
                        </v-carousel-item>
                    </v-carousel>
                </v-col>
                <v-col class="product-description mr-6" align="center" justify="center" v-if="products.length !== 0">
                    <h1 class="mt-16">
                        {{products.name}}
                    </h1>
                    <h3 class="mt-10">通常価格 {{products.price}}円 (税込)</h3>
                <v-col>

                    <v-btn color="red"
                    @click="destroyCart(products.id)"
                    v-if="cartProduct.includes(products.id)"
                    class="cart-button mt-4 py-6 px-16  font-weight-bold white--text" >
                    <h2>カートから削除する</h2>
                    </v-btn>

                        <v-btn color="orange accent-1"
                        @click="addToCart(products.id)"
                        v-else
                        class="cart-button mt-4 py-6 px-16 font-weight-bold black--text" >
                        <router-link to="/cart">
                        <h2>
                        カートに追加
                        </h2>
                        </router-link>
                        </v-btn>


                </v-col>

                <v-col>
                    <v-btn color="white" @click="unfavorite(products.id)"
                        v-if="favoriteId.includes(products.id)"
                        class="mt-2 py-3 px-10 font-weight-bold black--text" >
                        <h5>気になる商品から削除</h5>
                    </v-btn>

                    <v-btn color="white" @click="favorite(products.id)"
                    v-else
                    class="mt-2 py-3 px-10 font-weight-bold black--text">
                    <h5>気になる商品に追加</h5>
                    </v-btn>
                </v-col>
                <v-col>
                    <router-link to="/user-message">
                        <v-btn color="white" class="py-3 px-10 font-weight-bold black--text">
                        <h5>商品のお問い合わせ</h5>
                        </v-btn>
                    </router-link>
                </v-col>

                <v-col class="mt-2">
                    <v-divider width="60%"></v-divider>
                </v-col>
                <h2>商品詳細</h2>
                <p class="mt-4">素材  {{products.material}}</p>
                <p>サイズ  {{products.size}}</p>
                </v-col>
            </v-row>
            <v-row v-if="products.length !== 0">
                <v-col class="mt-16 mb-16 mr-6" align="center" justify="center">
                    <h1>商品説明</h1>
                    <p>{{products.information}}</p>
                </v-col>
            </v-row>
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
                products: [],
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
        },
        computed:{
        // carouselHeight () {
        //     switch (this.$vuetify.breakpoint.name) {
        //     case 'xs': return "50%"
        //     case 'sm': return "50%"
        //     case 'md': return "100"
        //     case 'lg': return "100%"
        //     case 'xl': return "100%"
        //     }
        // }
        }




    }
</script>

<style scoped>


a:link, a:visited, a:hover, a:active{
    color:black;
    text-decoration: none;
}
.product-description{


}
.cart-button{
    padding: 20px,30px;
}
</style>
