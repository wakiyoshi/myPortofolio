<template>
    <v-app>
        <v-main>
        <campaign-component/>
        <user-header-component @searchProducts="searchedProducts = $event"/>
        <menu-component/>
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
            }
        },
        mounted(){
            axios.get('/api/product')
            .then(response => {
                this.products = response.data;
            })
            .catch(error=>{
                console.log(error)
            });

        },


    }
</script>

<style scoped>

#product-list {
    display: flex;
    flex-wrap: wrap;
}
</style>
