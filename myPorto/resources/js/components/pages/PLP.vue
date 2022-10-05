<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
        <Breadcrumbs />
            <div id="container">
                <div>
                    <div id="product-list" >
                        <tr v-for="(product,index) in products" :key="index">
                            <td>
                                <div class="favorite-buttons" v-if="isLoggedin && products">
                                    <v-btn icon color="red"  @click="unfavorite(product.id)" v-if="favoriteId.includes(product.id)" >
                                        <v-icon>mdi-heart</v-icon>
                                    </v-btn>
                                    <v-btn icon color="black"  @click="favorite(product.id)" v-else>
                                        <v-icon>mdi-heart</v-icon>
                                    </v-btn>
                                </div>
                                <router-link v-if="products" :to="{ name:'pdp',params:{id: product.id}}" >
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
    </v-app>
</template>

<script>


    export default {

        data(){
            return{
                products: [],
                favoriteId: [],
                isLoggedin: null,
                page: 1,
                length: 0,
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
                    if(this.isLoggedin){
                    this.favoriteId = res.data
                    console.log(this.favoriteId)
                    }
                }).catch((err)=>{
                    console.log(err);
                });
            },
            favorite(id) {
                axios.post('/api/favorites/' + id ,
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
                    console.log(res)
                    const index = this.favoriteId.indexOf(id)
                    this.favoriteId.splice(index, 1);
                }).catch(function(error){
                    console.log(error);
                });
            },
            getProducts(){
                axios.get('/api/product?page=' + this.page)
                .then(response => {
                    const products = response.data;
                    this.products = products.data;
                    this.length = products.last_page;
                })
                .catch(error=>{
                    console.log(error)
                });
            },
            getCategoryProducts(category,page){
                axios.post('/api/category/product?page=' + page,category)
                .then(res => {
                    console.log(res.data.data)
                    this.products = res.data.data;
                    this.length = res.data.last_page
                })
                .catch(error=>{
                    console.log(error)
                });
            },
            getSearchProducts(keyword,page){
                axios.post('/api/search?page=' + page,keyword)
                .then((res)=>{
                console.log(res.data.data)
                this.products = res.data.data
                this.length = res.data.last_page
            })
            }
            },
            mounted()
            {
                if (this.$route.params.category){
                    console.log('category product')
                    this.page = 1;
                    this.getCategoryProducts({id: this.$route.params.category});
                }else if(this.$route.query.search){
                    this.page = 1;
                    this.getSearchProducts({keyword: this.$route.query.search});
                    console.log(this.keyword)
                }else{
                    this.page = 1;
                    this.getProducts();
                }
            },
            created(){
                this.checkLogin();
                if(this.isLoggedin){
                this.getFavorite();
                }
                this.$watch(
                ()=> this.$route.query,
                (query)=> {
                    if(query.search){
                    console.log(query.search)
                    this.page = 1;
                    this.getSearchProducts({keyword: query.search})
                    }else{
                    }
                })
                this.$watch(
                ()=> this.$route.params,
                (params)=> {
                    if (params.category) {
                    this.page = 1
                    console.log(params.category)
                    this.getCategoryProducts({id: params.category})
                    } else {
                    }
                })
                },
            watch: {
            page: function(newPage,oldPage)  {
                if (this.$route.params.category){
                    this.getCategoryProducts({id: this.$route.params.category},newPage)

                }else if(this.$route.query.search){

                    console.log();
                    this.getSearchProducts({keyword: this.$route.query.search},newPage);
                }else{
                    this.getProducts();
                }
            },
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

