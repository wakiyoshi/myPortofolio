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
                        <v-btn icon color="red"  @click="unfavorite(product)" v-if="product.hasFavorite">
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
                keyword:{
                    content: this.$route.query.search}



            }
        },
        methods:{
            favorite(product) {
                axios.get('/products/' + product.id + '/favorites')
                .then(res => {
                    this.result = res.data.result;
                }).catch(function(error) {
                    console.log(error);
                });
            },
            unfavorite(product) {
                axios.get('/products/' + product.id + '/unfavorites')
                .then(res => {
                    this.result = res.data.result;

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
            getCategoryProducts(page=1){
                axios.post('/api/category-product?page='+page,this.category)
                .then(response => {
                    console.log(response.data)
                    this.products = response.data;
                    this.length = this.products.last_page
                })
                .catch(error=>{
                    console.log(error)

                });

            },
            productSearch(){
                axios.post("/api/search",this.keyword)
                .then((response)=>{
                console.log(response)
                this.products = response.data
            })
            }
            },
            mounted(){
                if (Number.isInteger(this.$route.params.category)){
                    this.getCategoryProducts();
                }else if(this.$route.query.search){
                    this.productSearch();
                }else{
                    this.getProducts();
                }


                // this.hasFavorite();
            },
        watch: {
            $route() {
                if (Number.isInteger(this.$route.params.category)){
                    this.getCategoryProducts();
                    
                }else{
                    this.productSearch();
                }
            },
            page: function(newPage) {
            this.getProducts(this.page);
            },


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

