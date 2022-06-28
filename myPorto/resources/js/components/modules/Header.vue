<template>
    <v-content>
    <v-row id="site-header" >
        <v-col
        cols="12"
        sm="3">
        <router-link to="/">
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
        <v-text-field
            class="mt-8"
            color='black'
            dense
            label="アイテムを検索"
            prepend-icon='mdi-magnify'
          ></v-text-field>
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
            <v-btn icon color="black" class="mt-6 ">
                <v-icon>mdi-heart</v-icon>
            </v-btn>
        </v-col>
        <v-col
        cols="12"
        sm="2">
        <router-link to="/login">
            <v-btn
                class="pa-6 mt-4 font-weight-bold"
                color="orange accent-1"
                >ログインは<br>こちらから
            </v-btn>
        </router-link>
        </v-col>

    </v-row>
    </v-content>

</template>

<script>
import Campaign from './Campaign.vue'
    export default {
  components: { Campaign },
    }
</script>

<style lang="scss" scoped>
#site-header{
    margin:40 40 0 40;
}

</style>


