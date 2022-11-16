<template>
    <v-app>
        <admin-header-component/>
        <v-container fluid>
                <v-row align="center" justify="center">
                    <h1>商品登録</h1>
                    <router-link to= '/admin-product-index'>
                        <p class="mt-4 ml-16">
                        商品一覧に戻る ＜＜＜
                        </p>
                    </router-link>
                </v-row>
                <v-row class="mt-16" align="center" justify="center">
                    <h2>商品画像を最大6枚まで登録してください。</h2>
                </v-row>
                <form @submit.prevent="createProduct">
                <v-row class="image-row" align="center" justify="center">

                        <label>
                            <input type="file" class="file-input" ref="file1" @change="setImage1">商品画像１枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay1" style="max-width: 200px"></v-img>
                        <label>
                            <input type="file" class="file-input" ref="file2" @change="setImage2">商品画像2枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay2" style="max-width: 200px"></v-img>
                        <label>
                            <input type="file" class="file-input" ref="file3" @change="setImage3">商品画像3枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay3" style="max-width: 200px"></v-img>

                </v-row>
                <v-row class="image-row mt-16" align="center" justify="center">
                        <label>
                            <input type="file" class="file-input" ref="file4" @change="setImage4">商品画像4枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay4" style="max-width: 200px"></v-img>
                        <label>
                            <input type="file" class="file-input" ref="file5" @change="setImage5">商品画像5枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay5" style="max-width: 200px"></v-img>
                        <label>
                            <input type="file" class="file-input" ref="file6" @change="setImage6">商品画像6枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay6" style="max-width: 200px"></v-img>
                </v-row>
                <v-row  class="mt-16" align="center" justify="center">
                    <v-col lg="6" md="6"  sm="8" cols="8">
                        <p>商品名</p>
                        <v-text-field
                        dense
                        v-model="products.name"
                        outlined
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-col lg="6" md="6"  sm="8" cols="8">
                    <p>カテゴリーID</p>
                        <v-text-field
                        dense
                        v-model="products.category"
                        outlined
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-col lg="6" md="6"  sm="8" cols="8">
                        <p>販売価格</p>
                        <v-text-field
                        dense
                        v-model="products.price"
                        outlined
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-col lg="6" md="6"  sm="8" cols="8">
                        <p>数量</p>
                        <v-text-field
                        dense
                        v-model="products.quantity"
                        outlined
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-col lg="6" md="6"  sm="8" cols="8">
                        <p>素材</p>
                        <v-text-field
                        dense
                        v-model="products.material"
                        outlined
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-col lg="6" md="6"  sm="8" cols="8">
                        <p>サイズ</p>
                        <v-text-field
                        dense
                        v-model="products.size"
                        outlined
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-col lg="6" md="6"  sm="8" cols="8">
                        <p>商品説明</p>
                        <v-text-field
                        dense
                        v-model="products.information"
                        outlined
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-btn
                    class="mt-10 mb-16 py-3 px-8 font-weight-bold"
                    dark
                    color="black"
                    @click="createProduct">
                    + 上記の内容で商品を登録</v-btn>
                </v-row>
            </form>
        </v-container>
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
p{
    font-weight: bold;
}
.image-row{
margin-left: 9%;
}
label {
    padding: 10px 40px;
    color: #ffffff;
    background-color:gray;
    cursor: pointer;
}
.file-input{
    width: 100px;
    height: 100px;
}
input[type="file"] {
    display: none;
}

.output-image{
    /* max-width: 200px;
    max-height: 200px; */
    width: 200px;
    height: 200px;
}


</style>
