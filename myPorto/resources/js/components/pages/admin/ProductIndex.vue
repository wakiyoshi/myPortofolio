<template>
    <v-app>
        <admin-header-component/>
        <v-container fluid>
            <v-row align="center" justify="center" >
                <h2>商品管理ページ</h2>
                <router-link to='/admin-home'>
                    <h4 class=" ml-16">
                    管理者TOPページに戻る ＜＜＜
                    </h4>
                </router-link>
            </v-row>
            <v-row class="mt-16">
                <v-col lg="2" md="2" sm="2" cols="2">
                    <v-spacer lg="2" md="2" sm="2" cols="2"></v-spacer>
                </v-col>
                <v-col lg="3" md="3" sm="3" cols="3">
                    <form @submit.prevent="productSearch">
                        <v-text-field
                            v-model="keyword.content"
                            class=""
                            color='black'
                            label="アイテムを検索"
                            prepend-icon='mdi-magnify'
                            @enter="productSearch"
                        ></v-text-field>
                    </form>
                </v-col>

                <v-col lg="3" md="3" sm="2" cols="2">
                        <v-select  :items="sorts" label="並べ替え：" @input="changeSorts" v-model="rule" width="30%"></v-select>
                </v-col>

                <v-col lg="2" md="2" sm="2" cols="2" class="mt-3">
                        <router-link to='/admin-product'>
                            <v-btn
                            class="py-3 px-15 font-weight-bold"
                            dark
                            color="black">
                            + 商品を追加する
                            </v-btn>
                        </router-link>
                </v-col>
                <v-col lg="1" md="1" sm="1" cols="1">
                    <v-spacer></v-spacer>
                </v-col>
                </v-row>

                <v-row  align="center" justify="center" class="product-header mt-10">
                    <v-col lg="1" md="1" sm="1" cols="1">
                        <p>商品ID</p>
                    </v-col >
                    <v-col lg="2" md="2" sm="2" cols="2">
                        <v-spacer></v-spacer>
                    </v-col>
                    <v-col lg="2" md="2" sm="2" cols="2">
                        <p>商品名</p>
                    </v-col>
                    <v-col lg="2" md="2" sm="2" cols="2">
                        <p>販売価格</p>
                    </v-col>
                    <v-col lg="1" md="1" sm="1" cols="1">
                        <p>在庫数</p>
                    </v-col>
                    <v-col lg="1" md="1" sm="1" cols="1">
                        <v-spacer></v-spacer>
                    </v-col>
                </v-row>
                <v-row>
                    <v-divider class="mb-10"></v-divider>
                </v-row>
                <v-row  v-for="(product,index) in products" :key="index" class="d-flex" align="center" justify="center">
                        <v-col lg="1" md="1" sm="1" cols="1">
                            <p>{{product.id}}</p>
                        </v-col>
                        <v-col lg="2" md="2" sm="2" cols="2">
                            <v-img
                                class="mt-10"
                                :src="'/img/' + product.image1 "
                                width="200"
                                max-width="240"
                                >
                            </v-img>
                        </v-col>
                        <v-col lg="2" md="2" sm="2" cols="2">
                            <p>{{product.name}}</p>
                        </v-col>
                        <v-col lg="2" md="2" sm="2" cols="2">
                            <p>¥{{product.price}}</p>
                        </v-col>
                        <v-col lg="1" md="1" sm="1" cols="1">
                            <p>{{product.quantity}}</p>
                        </v-col>
                        <v-col lg="1" md="1" sm="1" cols="1">
                            <v-btn
                            class="mb-3 "
                            color = "red"
                            @click="deleteProduct(product.id)">
                            <h5>削除</h5>
                            </v-btn>
                        </v-col>
                        </v-row>
                <div>
                    <v-pagination
                        class="mt-16"
                        v-model="page"
                        :length="length"
                        >
                    </v-pagination>
                </div>
        </v-container>
    </v-app>

</template>

<script>

import pagination from 'laravel-vue-pagination'

    export default {
        components:{
            pagination
        },
        data(){
            return{
                sorts:[ 'ID（後順）','名前順','価格順','数量順' ],
                rule: null,
                products: null,
                sort_key: null,
                keyword:{
                    content: null,
                },
                imageUrl: null,
                page: 1,
                length: 0,

            }
        },
        methods:{
            getProducts(page=1){
                axios.get('/api/product?page=' + page)
                .then(response => {
                    const products = response.data;
                    this.products = products.data
                    this.length = products.last_page
                    this.changeSorts(this.rule)
                })
                .catch(error=>{
                    console.log(error)
                });
            },
            changeSorts(){
                if(this.rule === "名前順"){
                this.products.sort((a,b)=> {
                    return(a.name < b.name)? 1: (a.name > b.name)? - 1 : 0
                })
                }else if(this.rule === "数量順"){
                this.products.sort((a,b)=> {
                    return(a.quantity < b.quantity)? 1: (a.quantity > b.quantity)? - 1 : 0
                })
                }else if (this.rule === "ID（後順）"){
                 this.products = this.products.slice().reverse();

                }else if (this.rule === "価格順"){
                this.products.sort((a,b)=> {
                    return(a.price < b.price)? 1: (a.price > b.price)? - 1 : 0
                })
                }else{

                }

            },
            deleteProduct(id){
                axios.delete("/api/admin/product/delete/"+ id)
                .then(response => {
                    console.log(response);
                    this.getProducts(this.page);
                })
                .catch(error =>{
                    console.log(error);
                });
            },
            productSearch(){
                axios.post("/api/search?page=" + this.page ,this.keyword,
                )
                .then((response)=>{

                console.log(response)
                this.products = response.data.data
                })
                .catch(err=>{
                    console.log(err)
                })
            },
        },
        mounted(){
            axios.get('/admin/user')
            .then(response => {
                if (response.status === 200){
                console.log(response);
                }
                else{
                    this.$router.push("/admin-login")
                }
            })
            .catch(error=>{
                this.$router.push("/admin-login")
            });
        },
        created(){
            this.getProducts();
        },
        watch: {
        page: function(newPage) {
        this.getProducts(this.page);

        },
          },
    }
</script>

<style scoped>
a:link, a:visited, a:hover, a:active{

    text-decoration: none;
}
p{
    font-weight: bold;
}
.product-sorts{
    width: 50%;
}
.product-header{
    color: gray;
}

</style>
