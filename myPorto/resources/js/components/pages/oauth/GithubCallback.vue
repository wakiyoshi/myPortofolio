<template>
  <div>
    <p v-if="attempting">Githubでログインしています。</p>

    <template v-else>
      <p>Githubでのログインに失敗しました。</p>
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
            axios.get('/api/github/callback',{ params: this.$route.query })
            .then(res =>{
                console.log(res.data);
                    this.$store.dispatch('userAuth/setUsers', {name: res.data.user, auth: true, token:res.data.access_token});
                    this.$router.replace('/')
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
        this.callback()
    }
}
</script>
