<template>
  <p>Googleへリダイレクトしています</p>
</template>

<script>
export default {
    data(){
        return{}


    },
methods:{
  redirect(){
    axios.get('api/google/login')
      .then(res => {
          console.log(res)
        const googleAuthUrl = res.data
        window.location.href = googleAuthUrl
      })
      .catch(e => {
          console.log(e);
      })
  },
},
  created(){
      this.redirect()

  },
  mounted(){

  },

  updated () {



  }
}
</script>
