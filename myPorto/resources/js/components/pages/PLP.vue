<template>
    <v-app>
        <campaign-component/>
        <user-header-component/>

            <div id="container">
                <div id="breadcrumb-list">
                    <p>前のページ/このページのリンク</p>
                </div>
                <h2>Category-name</h2>
                <div>
                <select name="sorting" id="sorting-tab">並べ替え</select>
                <p id="page-list">〇〇件/1ページ目</p>
                <li>
                    
                </li>

            </div>



            </div>
        <footer-component/>

    </v-app>
</template>

<script>


    export default {

        data(){
            return{
                user: "",
            }
        },
        mounted(){
            axios.get('/api/user')
            .then(response => {
                this.user = response.data;
            })
            .catch(error=>{
                console.log(error)
            });


        },
        methods:{
            logout(){
                axios.post('/api/logout')
                .then(response => {
                    console.log(response);
                    localStorage.removeItem("auth");
                    this.$router.push("/login");
                })
                .catch(error =>{
                    console.log(error);
                });
            }

        }

    }
</script>

<style scoped>
#sub-contents{
    display: flex;
}
</style>
