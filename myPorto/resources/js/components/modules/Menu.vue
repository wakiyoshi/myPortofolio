<template>

    <v-container  fluid class="menu-container">
        <v-row class="category-list hidden-sm-and-down mt-2" >
            <v-col align="center" v-for="(category,index) in categories" :key="index"
             >
                <router-link :to="{ name:'plp-category',params:{category: category.id}}">
                    <h3 class="category-name">{{ category.name }}</h3>
                </router-link>
            </v-col>
        </v-row>
        <v-row >
            <v-divider width="98%"></v-divider>
        </v-row>
    </v-container>

</template>


<script>
    export default {
        data(){
            return{
                categories: null
            }
        },
        mounted(){
            axios.get('/api/category')
            .then(response => {
                this.categories = response.data;
            })
            .catch(error=>{
                console.log(error)
            });

        },

    }
</script>

<style lang="scss" scoped>

a:link, a:visited, a:hover, a:active{
    color:black;
    text-decoration: none;
}
.category-name{
    white-space: nowrap;
}
.category-list{
    white-space: nowrap;
}
</style>

