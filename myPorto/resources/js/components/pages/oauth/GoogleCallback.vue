<template>
  <div>
    <p v-if="attempting">Twitterでログインしています。</p>

    <template v-else>
      <p>Twitterでのログインに失敗しました。</p>
      <p>{{ failedMessage }}</p>
    </template>
  </div>
</template>

<script>

export default {

    data () {
        return {
        failedMessage: null
        }
    },
    methods: {
        callback(){
            axios.get('/api/google/callback',)
            .then(res =>{
                console.log(res.data);
                    this.$store.dispatch('userAuth/setUsers', {name: res.data.user, auth: true, token:res.data.access_token});
                    this.$router.push('/')
            })
            .catch(error =>{
                this.failedMessage = error.message
            })
        }

    },

  computed: {
    attempting () {
      return !this.failedMessage
    }
  },

    mounted(){
        // this.callback()
    }
}
</script>
