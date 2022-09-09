<template>
    <v-app>
        <v-main>
        <campaign-component/>
        <user-header-component @searchProducts="searchedProducts = $event"/>
        <menu-component/>
        <Breadcrumbs />
            <div id="container">
                <!-- <form @submit.prevent="sendToken">
                <input type="hidden" name="_token" :value="$store.state.csrf">
                </form> -->
                <div id="breadcrumb-list">
                    <p>前のページ/このページのリンク</p>
                </div>
                <h2>Category-name</h2>
                <div>
                <select name="sorting" id="sorting-tab">並べ替え</select>
                <p id="page-list">〇〇件/1ページ目</p>
                <div id="product-list" >



                <tr v-for="(product,index) in products" :key="index">
                    <td>
                        <v-btn icon color="red"  @click="unfavorite(product)" v-if="product.isFavorite">
                            <v-icon>mdi-heart</v-icon>
                        </v-btn>
                        <v-btn icon color="black"  @click="favorite(product)" v-else>
                            <v-icon>mdi-heart</v-icon>
                        </v-btn>


                        <router-link :to="{ name:'pdp',params:{id: product.id}}">
                        <v-img
                        max-width="200px"
                        :src="'/img/'+ product.image1"
                        >
                        </v-img>

                        <div class="product-name">{{product.name}}</div>
                        <div>{{product.price}}円 (税込)</div>
                        </router-link>
                    </td>
               </tr>
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
                products: null,
                page:1,
                length: 0,
                result: false,
                category:{
                    id: this.$route.params.category
                },
                params: this.$route.params.category,
                keyword:{
                    content: this.$route.query.search},

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
                .then ((res) => {
                console.log(res)
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
            favorite(product) {
                axios.post('/api/favorites/'+ product.id )
                .then(res => {
                    this.result = res.data.result;
                }).catch(function(error) {
                    console.log(error);
                });
            },
            unfavorite(product) {
                axios.get('/api/unfavorites/'+ product.id )
                .then(res => {
                    console.log(res)
                }).catch(function(error){
                    console.log(error);
                });
            },
            // hasFavorite() {
            //     axios.get('/products/hasfavorites')
            //     .then(res => {
            //         this.result = res.data;

            //     }).catch(function(error){
            //         console.log(error);
            //     });
            // },
            getProducts(page=1){
            axios.get('/api/product?page=' + page)
            .then(response => {
                const products = response.data;
                this.products = products.data
                this.length = products.last_page
                this.result = products.hasFavorite
            })
            .catch(error=>{
                console.log(error)
            });
            },
            getCategoryProducts(category){
                axios.post('/api/category-product?page='+this.page,category)
                .then(response => {
                    console.log(response.data)
                    this.products = response.data;
                    this.length = this.products.last_page
                })
                .catch(error=>{
                    console.log(error)
                });

            },
            productSearch(keyword){
                axios.post("/api/search",keyword)
                .then((response)=>{
                console.log(response)
                this.products = response.data
            })
            }
            },
            mounted(){
                this.userInfo();
                if (this.$route.params.category){
                    this.getCategoryProducts(this.category);
                    console.log('category product')
                }else if(this.$route.query.search){
                    this.productSearch(this.keyword);
                }else{
                    this.getProducts();
                    console.log(this.$route.params.category)
                }


                // this.hasFavorite();
            },
            beforeRouteUpdate (to, from, next) {
            // `this` を使用
            if(to.query.search){
            const categoryId = to.params.category
            const param = {id: categoryId}
            console.log(1)

            this.getCategoryProducts(param)
            next()
            }else if(to.params.category){
            const keyword = to.query.search
            const param = {content: keyword}
            this.productSearch(param)
            next()
            }
            },

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

