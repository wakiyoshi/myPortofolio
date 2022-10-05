<template>
    <v-app>
        <v-main>
            <admin-header-component/>
            <div id="container">

                <h1>商品管理ページ</h1>
                    <router-link to= '/admin-home'>
                    <p>
                    管理者TOPページに戻る</p>
                </router-link>
                <v-select :items="sorts" label="並べ替え：" @input="changeSorts"></v-select>
                <router-link to='/admin-product'>
                    <v-btn
                    class="py-3 px-15 font-weight-bold"
                    dark
                    color="black">
                    + 商品を追加する</v-btn>
                </router-link>
                <form @submit.prevent="productSearch">
                    <v-text-field
                        v-model="keyword.content"
                        class="mt-8"
                        color='black'
                        dense
                        label="アイテムを検索"
                        prepend-icon='mdi-magnify'
                        @enter="productSearch"
                    ></v-text-field>
                </form>
                <div class="colomn-name">
                    <p>id</p>
                    <p>商品名</p>
                    <p>商品価格</p>
                    <p>数量</p>
                    <p>削除</p>
                </div>
                <v-divider style="border-width: 2px; color: gray;"></v-divider>

                <div id="searchComponent">


                <div class="product-list">
                <tr v-for="(product,index) in products" :key="index">
                    <td>
                        <p>{{product.id}}</p>
                        <v-img
                        :src="imageUrl"
                        >
                        <p ref="image">{{product.image1}}</p>
                        </v-img>
                        <p>{{product.name}}</p>
                        <p>¥{{product.price}}</p>
                        <p>{{product.quantity}}</p>

                        <v-btn
                        color = "red"
                        @click="deleteProduct(product.id)">削除</v-btn>
                    </td>
                </tr>
                <div>
                    <v-pagination
                        v-model="page"
                        :length="length"
                        >
                    </v-pagination>
                </div>
                </div>
                </div>
            </div>
        </v-main>
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
                sorts:[ 'ID順','名前順','数量順' ],
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
                })
                .catch(error=>{
                    console.log(error)
                });


            },
            changeSorts(){
                const sorts = this.$refs.sorts;
                sortBy(sorts);
            },
            deleteProduct(id){
                axios.delete("/api/admin/product/delete/"+ id)
                .then(response => {
                    console.log(response);
                    this.getProducts();
                })
                .catch(error =>{
                    console.log(error);
                });
            },
            productSearch(){
                axios.post("/api/search",this.keyword)
                .then((response)=>{
                console.log(response)
                this.products = response.data
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

        computed: {

        },



    }
</script>

<style scoped>
a{
    text-decoration: none;
}
.colomn-name{
    display: flex;
    }
.colomn-name p{
    padding-left: 100px
}
.product-list tr td{
    display: flex;

}
.product-list tr td p{
    margin-left: 100px

};
.product-list tr td button{
    margin-left: 100px

}

</style>
