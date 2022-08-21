<template>
    <v-app>
        <v-main>
            <div id="container">
                <div class="breadcrumb-area">
                    <div class="breadcrumb-item">
                    <div v-for="(v,index) in breadcrumbs" :key="index">
                        <div v-if="v.path">
                        <router-link :to="v.path">
                            <span class="link">{{v.name}}</span>
                        </router-link>
                        <span class="space">></span>
                        </div>
                            <div v-else>
                            {{v.name}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </v-main>
    </v-app>

</template>

// <script>


    export default {

        data(){
            return{
                breadcrumbs: null,



            }
        },
        methods:{

        },
        mounted(){
       },


    }
</script>

<style scoped>
</style>
