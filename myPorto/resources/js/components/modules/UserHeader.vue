<template>
    <v-main>
    <v-row id="site-header" >
        <v-col
        cols="12"
        sm="3">
        <router-link to="/user-home">
            <v-img
            src="/img/logo.png"
            max-width="200">
            </v-img>
        </router-link>
        </v-col>
        <v-col
          cols="12"
          sm="4"
        >
        <div id="searchComponent">
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
        </div>
        </v-col>
        <v-col
        cols='12'
        sm='1'
        >
            <v-spacer></v-spacer>
        </v-col>
        <v-col
        cols="24"
        sm="1">
            <v-btn icon color="black" class="mt-6 ">
                <v-icon>mdi-cart</v-icon>
            </v-btn>
        </v-col>
        <v-col
        cols="12"
        sm="1"
        >
        <router-link to="wishlist">
            <v-btn icon color="black" class="mt-6 ">
                <v-icon>mdi-heart</v-icon>
            </v-btn>
        </router-link>
        </v-col>
        <v-col
        cols="12"
        sm="2">
        <router-link to="/user-information">
            <v-btn icon color="black" class="mt-6">
                <v-icon>mdi-account</v-icon>
            </v-btn>
        </router-link>
 
        </v-col>

    </v-row>
    </v-main>
</template>

<script>
    export default {
        data() {
            return {
                keyword:{
                content: null,
                },
                product: null,
            }
        },
        methods:{
            productSearch(){
                axios.post("/api/search",this.keyword)
                .then((response)=>{
                console.log(response)
                this.product = response.data
                this.$router.push({name:"plp-search",query:{ search:this.product}})
                .catch(err => {
                    console.log(err)
                    console.log(this.product)
                    this.$emit('searchProducts',this.product)
                    })
                })
                .catch(err=>{
                    console.log(err)
                })
            },
            getUser(){
            axios.get('/api/user')
            .then(response => {
                if (response.status === 200){
                    return false;
                }
                else{
                    return false;
                }
            })
            .catch(error=>{
                console.log(error)
            });
            }



        }
    }

</script>

<style lang="scss" scoped>
#site-header{
    margin:40 40 0 40;
}
a{
    text-decoration: none;
}

</style>


