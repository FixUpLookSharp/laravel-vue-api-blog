export default {
    actions: {
        async showPost(ctx, title)
        {
            console.log(title)
           await axios({
               method: 'get',
               url: '/api/V1/article/' + title,
           }).then((response) => {
               console.log(response.data)
           }).catch(err => {
               console.log(err.response.data)
           })

        }
    },
    mutations: {

    },
    state: {

    },
    getters: {

    }
}
