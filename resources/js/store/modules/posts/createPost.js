export default {
    actions: {
        async sendPost(ctx, data) {
         let creator_id = await ctx.getters.getAuth.id
            data.creator_id = creator_id
            console.log(data.photo)
            await axios({
                method: 'post',
                url: '/api/V1/article',
                data: {
                    category_id: data.category_id,
                    creator_id: data.creator_id,
                    description: data.description,
                    photo: data.photo,
                    short_description: data.short_description,
                    title: data.title,
                }
            }).then((response) => {
                console.log(response.data)
            }).catch(error => {
                console.log(error.response.data)
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
