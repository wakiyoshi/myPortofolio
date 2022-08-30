<template>
    <v-app>
        <v-main>
        <campaign-component/>
        <user-header-component @searchProducts="searchedProducts = $event"/>
        <menu-component/>
        <Breadcrumbs />
            <div id="container">
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
                result: false

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
            }
            },
            mounted(){
                this.getProducts();
                // this.hasFavorite();
            },
        watch: {
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

