<template>
    <v-app>
        <campaign-component/>
        <user-header-component :login="isLoggedin"/>
        <menu-component/>
        <Breadcrumbs />
            <v-container fluid>
                <v-row >
                    <v-col align="center" justify="center">
                        <v-select class="select-sorting" :items="sorts" label="並べ替え:" @input="changeSorts" v-model="sorting_rule" filled  ></v-select>
                    </v-col>
                </v-row>
                <v-row >
                    <v-col  v-for="(product,index) in products" :key="index" class="favorite-buttons" >
                        <v-col v-if="isLoggedin && products" align="start" justify="start">
                            <v-btn  icon color="red"  @click="unfavorite(product.id)" v-if="favoriteId.includes(product.id)"  >
                                <v-icon>mdi-heart</v-icon>
                            </v-btn>
                            <v-btn icon color="black"  @click="favorite(product.id)" v-else >
                                <v-icon>mdi-heart</v-icon>
                            </v-btn>
                        </v-col>
                        <v-row class="ml-16">
                            <div align="center" justify="center">
                            <router-link v-if="products" :to="{ name:'pdp',params:{id: product.id}}" >
                                <v-img
                                max-width="200px"
                                max-height="200px"
                                width="200px"
                                height="200px"
                                :src="'/storage/img/'+ product.image1"
                                >
                                </v-img>
                            </router-link>
                            <h3>{{product.name}}</h3>
                            <h5>{{product.price}}円 (税込)</h5>
                            </div>
                        </v-row>

                    </v-col>


                </v-row>
                <v-row class="mt-16 mb-16" center="align" justify="center">
                    <v-pagination
                        v-model="page"
                        :length="length"
                    >
                    </v-pagination>
                </v-row>
            </v-container>
        <footer-component/>
    </v-app>
</template>

<script>


    export default {

        data(){
            return{
                sorts:[ '新着順','名前順','価格の安い順', '価格の高い順' ],
                sorting_rule: null,
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
            },
            changeSorts(){
                if(this.sorting_rule === "新着順"){
                 this.products = this.products.slice().reverse();
                }

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
                this.changeSorts()

                if (this.$route.params.category){
                    this.getCategoryProducts({id: this.$route.params.category},newPage)

                }else if(this.$route.query.search){
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
a:link, a:visited, a:hover, a:active{
    color:black;
    text-decoration: none;
}
#product-list {
    display: flex;
    flex-wrap: wrap;
}
.select-sorting{
    width: 40%
}
</style>

