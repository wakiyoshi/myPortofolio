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

                        <v-btn icon color="red"  @click="unfavorite(product.id)" v-if="favoriteId.includes(product.id)">
                            <v-icon>mdi-heart</v-icon>
                        </v-btn>

                        <v-btn icon color="black"  @click="favorite(product.id)" v-else>
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
                category:{
                    id: this.$route.params.category
                },
                params: this.$route.params.category,
                keyword:{
                    content: this.$route.query.search},
                favoriteId: null,
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
                    console.log(res)
                    const index = this.favoriteId.indexOf(id)
                    this.favoriteId.splice(index, 1);
                }).catch(function(error){
                    console.log(error);
                });
            },
            getProducts(page=1){
            axios.get('/api/product?page=' + page)
            .then(response => {
                const products = response.data;
                this.products = products.data
                this.length = products.last_page

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
            getSearchProducts(keyword){
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
                    this.getSearchProducts(this.keyword);
                }else{
                    this.getProducts();
                }
            },
            created(){
                this.getFavorite();

                this.$watch(
                ()=> this.$route.query,
                (query)=> {
                    if(query.search){
                    console.log(query.search)
                    this.getSearchProducts({content: query.search})
                    }else{
                    console.log('no query')
                    }


                })

                this.$watch(
                ()=> this.$route.params,
                (params)=> {
                    if(params.category){
                    console.log(params.category)
                    this.getCategoryProducts({id: params.category})
                    }else{
                    console.log('no category')
                    }
                })
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

