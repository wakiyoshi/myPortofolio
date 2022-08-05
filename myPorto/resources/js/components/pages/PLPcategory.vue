<template>
    <v-app>
        <v-main>
        <campaign-component/>
        <user-header-component @searchProducts="search = $event"/>
        <menu-component/>
        <Breadcrumbs />
            <div id="container">

                <h2>Category-name</h2>
                <div>
                <select name="sorting" id="sorting-tab">並べ替え</select>
                <p id="page-list">〇〇件/1ページ目</p>
                <div id="product-list" >

                <tr v-for="(product,index) in products" :key="index">
                    <td>
                        <router-link :to="{ name:'pdp',params:{id: product.id}}">
                        <v-img
                        max-width="200px"
                        :src="'/img/'+ product.image1"
                        >
                        </v-img>
                        <div>{{product.name}}</div>
                        <div>{{product.price}}円 (税込)</div>
                        </router-link>
                    </td>
               </tr>
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
                category:{
                    id: this.$route.params.category
                },
            }
        },


        mounted(){

            axios.post('/api/category-product',this.category)
            .then(response => {
                this.products = response.data;
                console.log(response.data)
            })
            .catch(error=>{
                console.log(error)
            });
        },
        watch:{
            $route(to,from){
                this.$router.go({path: this.$router.currentRoute.path, params:{category: this.category},force: true})
        },
        }


  }










</script>

<style scoped>

#product-list {
    display: flex;
    flex-wrap: wrap;
}
</style>
