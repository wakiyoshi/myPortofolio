<template>
    <div class="container" :class="{'loading': loading}">
        <h1>hello </h1>
        <div class="list-group">
            <tr v-for="(user,index) in users" :key="index">
                <td>{{user.name}}</td>
            </tr>
            <p>{{ this.users }}</p>
    </div>
    <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    />
      <v-carousel
        cycle
        height="400"
        hide-delimiter-background
        show-arrows-on-hover
      >
      </v-carousel>
      <v-card
        elevation="2"
    ></v-card>

             <v-row
              class="fill-height"
              align="center"
              justify="center"
            ></v-row>
    </v-app>
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
                axios.get('/api/tests')
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
