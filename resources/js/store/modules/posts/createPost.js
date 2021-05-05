export default {
    actions: {
        async sendPost(ctx, data) {
         let creator_id = await ctx.getters.getAuth.id
            data.creator_id = creator_id
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let  data2 = await new FormData();
            await data2.append('photo', data.photo)
            await data2.append('category_id', data.category_id)
            await data2.append('creator_id', data.creator_id)
            await data2.append('description', data.description)
            await data2.append('short_description', data.short_description)
            await data2.append('title', data.title)

            await axios.post('/api/V1/article', data2, config)
                .then(function (res) {
                    console.log(res.data);
                })
                .catch(function (err) {
                    console.log(err.response.data)
                });
        }
    },
    mutations: {

    },
    state: {
    },
    getters: {

    }
}
