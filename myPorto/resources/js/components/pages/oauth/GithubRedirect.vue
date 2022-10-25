<template>
    <p>Githubへリダイレクトしています</p>
</template>

<script>
export default {
    methods:{
        redirect(){
            axios.get('api/github/login')
            .then(res => {
                console.log(res)
                const githubAuthUrl = res.data
                window.location.href = githubAuthUrl
            })
            .catch(e => {
                console.log(e);
            })
        },
        },
        created(){
            this.redirect()
        },
    }
</script>
