<template>

    <v-container>

    <v-system-bar
      window
      dark
      app
    >
    <span style="color:white;">〜5/25日 クーポン利用で10％オフ</span>

    </v-system-bar>

    <v-main >
    <v-row>
    <v-toolbar
      height="100px"
      color="white accent-4"
      flat
    >

    <v-img
    justify="left"
    src="/img/logo.png"
    max-width="200">

    </v-img>

      <v-spacer></v-spacer>
      <v-icon color='black'>fas fa-search</v-icon>
        <v-col
          cols="12"
          sm="6"
          md="4"
        >
        <v-text-field
            color='black'
            dense
            label="アイテムを検索"
            append-icon='mdi-search'
          ></v-text-field>
        </v-col>

        <v-btn icon color="black">
        <v-icon>mdi-cart</v-icon>
        </v-btn>

        <v-btn icon color="black">
        <v-icon>mdi-heart</v-icon>
        </v-btn>
        <v-btn
        class="pa-6 ma-15 font-weight-bold"
        color="orange accent-1"
        >ログインは<br>こちらから</v-btn>

    </v-toolbar>
    </v-row>

            </v-main>

    </v-container>
</template>

<script>
    export default {
    }
</script>

<style lang="scss" scoped>

</style>


