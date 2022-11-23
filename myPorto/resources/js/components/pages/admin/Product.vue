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
                <v-row class="mt-16 mb-10" align="center" justify="center">
                    <h2>商品画像を最大6枚まで登録してください。</h2>
                </v-row>
                <form @submit.prevent="createProduct">
                <v-row class="image-row" align="center" justify="center">

                        <label>
                            <input type="file" ref="file1" class="file-input"  @change="setImage1">商品画像１枚目を<br>選択してください。
                        </label>


                        <v-img class="output-image" :src="imageDisplay1"  style="max-width: 200px"></v-img>
                        <label>
                            <input type="file" class="file-input" ref="file2" @change="setImage2">商品画像2枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay2" style="max-width: 200px"></v-img>


                </v-row>
                <v-row class="image-row " align="center" justify="center">
                        <label>
                            <input type="file" class="file-input" ref="file3" @change="setImage3">商品画像3枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay3" style="max-width: 200px"></v-img>
                        <label>
                            <input type="file" class="file-input" ref="file4" @change="setImage4">商品画像4枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay4" style="max-width: 200px"></v-img>
                </v-row>
                <v-row class="image-row " align="center" justify="center">

                        <label>
                            <input type="file" class="file-input" ref="file5" @change="setImage5">商品画像5枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay5" style="max-width: 200px"></v-img>
                        <label>
                            <input type="file" class="file-input" ref="file6" @change="setImage6">商品画像6枚目を<br>選択してください。
                        </label>
                        <v-img class="output-image" :src="imageDisplay6" style="max-width: 200px"></v-img>
                </v-row>

                <v-row  class="mt-10" align="center" justify="center">
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
                    <v-col v-if="errors.length !== 0 | !errors" align="center" justify="center">
                        <tr v-for="(error,index) in errors" :key="index">
                            <td> <h3  class="red--text mt-6">{{ error }}</h3></td>
                        </tr>
                    </v-col>
                </v-row>
                <v-row v-if="message">
                    <v-col align="center" justify="center">
                        <h3 class="blue--text">{{ message }}</h3>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-btn
                    class="mt-10 mb-16 py-3 px-8 font-weight-bold"
                    dark
                    color="black"
                    @click="createProduct()">
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
            message: null,
            errors: [],
            imageDisplay1: null,
            imageDisplay2: null,
            imageDisplay3: null,
            imageDisplay4: null,
            imageDisplay5: null,
            imageDisplay6: null,
            image1: null,
            image2: null,
            image3: null,
            image4: null,
            image5: null,
            image6: null,
            products: {
                name: null,
                category: null,
                quantity: null,
                price: null,
                material: null,
                size: null,
                information: null,
                imageName1: null,
                imageName2: null,
                imageName3: null,
                imageName4: null,
                imageName5: null,
                imageName6: null,
            },
        }
    },
    methods:{
        setImage1(e) {
        const files = this.$refs.file1;
        const fileImg = files.files[0];
        this.imageDisplay1 = window.URL.createObjectURL(fileImg);
        this.image1 = e.target.files[0];
        this.products.imageName1 = fileImg.name;
        console.log(this.products.image1)

        },
        setImage2(e) {
        const files = this.$refs.file2;
        const fileImg = files.files[0];
        this.imageDisplay2 = window.URL.createObjectURL(fileImg);
        this.image2 = e.target.files[0];
        this.products.imageName2 = fileImg.name;
        console.log(this.products.image2)


        },
        setImage3(e) {
        const files = this.$refs.file3;
        const fileImg = files.files[0];
        this.imageDisplay3 = window.URL.createObjectURL(fileImg);
        this.image3 = e.target.files[0];
        this.products.imageName3 = fileImg.name;

        },
        setImage4(e) {
        const files = this.$refs.file4;
        const fileImg = files.files[0];
        this.imageDisplay4 = window.URL.createObjectURL(fileImg);
        this.image4 = e.target.files[0];
        this.products.imageName4 = fileImg.name;

        },
        setImage5(e) {
        const files = this.$refs.file5;
        const fileImg = files.files[0];
        this.imageDisplay5 = window.URL.createObjectURL(fileImg);
        this.image5 = e.target.files[0];
        this.products.imageName5 = fileImg.name;

        },
        setImage6(e) {
        const files = this.$refs.file6;
        const fileImg = files.files[0];
        this.imageDisplay6 = window.URL.createObjectURL(fileImg);
        this.image6 = e.target.files[0];
        this.products.imageName6 = fileImg.name;

        },
        createProduct(){

            const formData = new FormData()
            Object.keys(this.products).forEach(key => {
                formData.append(key, this.products[key]);
            });
            // formData.append('products',JSON.stringify(this.products))
            formData.append('image1',this.image1)
            if(this.image2){
            formData.append('image2',this.image2)
            }
            if(this.image3){
            formData.append('image3',this.image3)
            }
            if(this.image4){
            formData.append('image4',this.image4)
            }
            if(this.image5){
            formData.append('image5',this.image5)
            }
            if(this.image6){
            formData.append('image6',this.image6)
            }
            const config =  { headers: {
            'content-type': 'multipart/form-data',
            },
            }
            axios.post('api/admin/product/create', formData ,config)
            .then(response => {
                console.log(response);
                
                this.message = response.data.message
                console.log(response.data.message)


            })
            .catch(error =>{
                console.log(error);
                    this.errors = []
                    const array = error.response.data.errors
                    if(array){
                    Object.keys(array).forEach(key => this.errors.push(array[key][0]))
                    }
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

    width: 200px;
    height: 200px;
}


</style>
