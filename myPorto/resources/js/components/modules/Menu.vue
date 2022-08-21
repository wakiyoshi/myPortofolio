<template>
    <v-main >
        <div id="category-menu" >
            <tr v-for="(category,index) in categories" :key="index">
                <td>
                    <router-link :to="{ name:'plp-category',params:{category: category.id}}">
                        <p>{{ category.name }}</p>
                    </router-link>
                </td>
            </tr>
        </div>
        <div id="menu-divider">
            <v-divider
            light>
            </v-divider>
        </div>

    </v-main>



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


#category-menu {

    display:flex;
    list-style:none;
    font-size:18px;
    margin-top: 0px;
    margin-left: 80px;

}
a{
    text-decoration: none;
}

p{
    text-decoration: none;

    margin: 10px;
}

#menu-divider{
    width:80%;

    margin-left: 80px;
    margin-right: 80px;
}


</style>

