<template>
    <div class="container" :class="{'loading': loading}">
        <h1>hello </h1>
        <div class="list-group">
            <tr v-for="(user,index) in users" :key="index">
                <td>{{user.name}}</td>
            </tr>

        </div>

    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                users:[],
                loading:true
            }
        },
        mounted(){
            this.loadUsers();
        },
        methods: {
            loadUsers: function (){
                axios.get('/api/user')
                .then((res) => {
                    //response.dataが取得したデータで、最後のdataでそのデータを取り出している。
                    this.users = res.data.data;
                    this.loading = false;
                })
                .catch((error)=>{
                    console.log(error);
                });
            }

        }
    }
</script>
