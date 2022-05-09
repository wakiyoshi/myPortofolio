<template>
    <div class="container" :class="{'loading': loading}">
        <h1>hello </h1>
        <div class="list-group">
            <tr v-for="(user,index) in users" :key="index">
                <td>{{user.name}}</td>
            </tr>
            <p>{{ this.users }}</p>


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

        methods: {
            loadUsers: function (){
                axios.get('/api/users')
                .then((res) => {
                    //response.dataが取得したデータで、最後のdataでそのデータを取り出している。
                    this.users = res.data.data;
                    this.loading = false;
                    console.log('成功',this.users)
                })
                .catch((error)=>{
                    console.log(error);
                });
            }

        },
        mounted(){
            this.loadUsers();
        },
    }
</script>
