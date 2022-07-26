<template>
    <v-app>
        <admin-header-component/>
        <v-main>
            <div id="container">
                <h2>商品登録</h2>
                <router-link to= '/admin-product-index'>
                    <p>
                    メッセージ一覧に戻る
                    </p>
                </router-link>
                <form @submit.prevent="createProduct">
                <v-row>
                    <v-col cols="" sm="8">
                        <input type="file" ref="file1" @change="setImage1">
                        <v-img :src="imageDisplay1" style="max-width: 200px"></v-img>
                    </v-col>
                    <v-col cols="">
                        <input type="file" ref="file2" @change="setImage2">
                        <v-img :src="imageDisplay2" style="max-width: 200px"></v-img>
                    </v-col>
                    <v-col cols="">
                        <input type="file" ref="file3" @change="setImage3">
                        <v-img :src="imageDisplay3" style="max-width: 200px"></v-img>
                   </v-col>

                </v-row>
                <v-row>
                    <v-col cols="" sm="8">
                        <input type="file" ref="file4" @change="setImage4">
                        <v-img :src="imageDisplay4" style="max-width: 200px"></v-img>
                        <input type="file" ref="file5" @change="setImage5">
                        <v-img :src="imageDisplay5" style="max-width: 200px"></v-img>
                        <input type="file" ref="file6" @change="setImage6">
                        <v-img :src="imageDisplay6" style="max-width: 200px"></v-img>
                    </v-col>
                </v-row>
                    <p>商品名</p>
                    <v-text-field
                    dense
                    v-model="products.name"
                    outlined
                    ></v-text-field>
                    <p>カテゴリーID</p>
                    <v-text-field
                    dense
                    v-model="products.category"
                    outlined
                    ></v-text-field>
                    <p>販売価格</p>
                    <v-text-field
                    dense
                    v-model="products.price"
                    outlined
                    ></v-text-field>
                    <p>数量</p>
                    <v-text-field
                    dense
                    v-model="products.quantity"
                    outlined
                    ></v-text-field>
                    <p>素材</p>
                    <v-text-field
                    dense
                    v-model="products.material"
                    outlined
                    ></v-text-field>
                    <p>サイズ</p>
                    <v-text-field
                    dense
                    v-model="products.size"
                    outlined
                    ></v-text-field>
                    <p>商品説明</p>
                    <v-text-field
                    dense
                    v-model="products.information"
                    outlined
                    ></v-text-field>

                    <v-btn
                    class="py-3 px-8 font-weight-bold"
                    dark
                    color="black"
                    @click="createProduct">
                    + 商品を追加</v-btn>
                </form>
            </div>
        </v-main>
    </v-app>

</template>

<script>


export default {
    data(){
        return{
            imageDisplay1: null,
            imageDisplay2: null,
            imageDisplay3: null,
            imageDisplay4: null,
            imageDisplay5: null,
            imageDisplay6: null,

            products: {
                image1: null,
                image2: null,
                image3: null,
                image4: null,
                image5: null,
                image6: null,
                name: null,
                category: null,
                quantity: null,
                price: null,
                material: null,
                size: null,
                information: null,
            }

        }
    },
    methods:{
        setImage1(e) {
        const files = this.$refs.file1;
        const fileImg = files.files[0];
        this.imageDisplay1 = window.URL.createObjectURL(fileImg);
        this.products.image1 = fileImg.name;
        },
        setImage2(e) {
        const files = this.$refs.file2;
        const fileImg = files.files[0];
        this.imageDisplay2 = window.URL.createObjectURL(fileImg);
        this.products.image2 = fileImg.name;
        },
        setImage3(e) {
        const files = this.$refs.file3;
        const fileImg = files.files[0];
        this.imageDisplay3 = window.URL.createObjectURL(fileImg);
        this.products.image3 = fileImg.name;
        },
        setImage4(e) {
        const files = this.$refs.file4;
        const fileImg = files.files[0];
        this.imageDisplay4 = window.URL.createObjectURL(fileImg);
        this.products.image4 = fileImg.name;
        },
        setImage5(e) {
        const files = this.$refs.file5;
        const fileImg = files.files[0];
        this.imageDisplay5 = window.URL.createObjectURL(fileImg);
        this.products.image5 = fileImg.name;
        },
        setImage6(e) {
        const files = this.$refs.file6;
        const fileImg = files.files[0];
        this.imageDisplay6 = window.URL.createObjectURL(fileImg);
        this.products.image6 = fileImg.name;
        },
        createProduct(){
            axios.post('api/admin/product/create', this.products)
            .then(response => {
                console.log(response);
                this.$router.go({path: this.$router.currentRoute.path, force: true})
                this.products = null
            })
            .catch(error =>{
                console.log(error);
            });
    }
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


}
</script>

<style scoped>
a{
    text-decoration: none;
}
</style>
