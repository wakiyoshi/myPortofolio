<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>
        <menu-component/>
                <div id="breadcrumb-list">
                    <p>前のページ/商品詳細</p>
                </div>
            <div id="container">
                <div id="product-image">
                <v-carousel
                height="700"
                hide-delimiters
                >
                    <div></div>
                    <v-carousel-item
                    width="50%"
                    v-for="(image,i) in filteredImage"
                    :key="i"
                    :src="'/img/'+ image"
                    ></v-carousel-item>
                </v-carousel>

                </div>
                <h1 id="product-name" >
                    {{products.name}}
                </h1>
                <p id="product-price">通常価格 {{products.price}}円 (税込)</p>
                <router-link to="/wishlist">
                    <p id="add-wishlist">気になる商品に追加</p>
                </router-link>
                <router-link to="/message">
                    <p id="send-message">商品についてのお問い合わせ</p>
                </router-link>
                <v-divider></v-divider>
                <h2>商品詳細</h2>
                <p>素材  {{products.material}}</p>
                <p>サイズ  {{products.size}}</p>
            <div id="product-information">
                <h1>商品説明</h1>
                <p>{{products.information}}</p>
            </div>
                <div>
                </div>
            </div>
        <footer-component/>

    </v-app>
</template>

<script>


    export default {

        data(){
            return{
                products: "",
                images: "",
                filteredImage:"",
            }
        },

        mounted(){
            axios.get('/api/product')
            .then(response => {
                this.data = response.data;
                this.products = this.data[this.$route.params.id -1]
                this.images = [this.products.image1,this.products.image2,this.products.image3,
                this.products.image4,this.products.image5,this.products.image6,]
                this.filteredImage = this.images.filter((e)=> e !== null)
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
#product-image{
    width: 80%;
    align-items: center;
}
</style>
