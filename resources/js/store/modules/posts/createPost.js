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
                    //здесь должен быть редирект на определенную статью
                    console.log(res.data);
                })
                .catch(function (err) {
                    let short_description = {}
                    let title = {}
                    let category_id = {}
                    let description = {}
                    let photo = {}
                    title = err.response.data.errors.title ? err.response.data.errors.title[0] : null
                    category_id = err.response.data.errors.category_id ? 'errors.' + 'category' : null
                    short_description = err.response.data.errors.short_description ? 'errors.' + 'short_description' : null
                    description = err.response.data.errors.description ? err.response.data.errors.description[0] : null
                    photo = err.response.data.errors.photo ? 'errors.' + 'photo' : null

                    ctx.commit("updateErrorShortDescription", short_description)
                    ctx.commit("updateErrorCategoryId", category_id)
                    ctx.commit("updateErrorPhoto", photo)
                    ctx.commit("updateErrorTitle", title)
                    ctx.commit("updateErrorDescription", description)

                });
        }
    },
    mutations: {
        updateErrorShortDescription(state, short_description) {
            state.short_description = short_description
        },
        updateErrorCategoryId(state, category_id) {
            state.category_id = category_id
        },
        updateErrorPhoto(state, photo) {
            state.photo = photo
        },
        updateErrorTitle(state, title) {
            state.title = title
        },
        updateErrorDescription(state, description) {
            state.description = description
        },
    },
    state: {
        short_description: null,
        category_id: null,
        photo: null,
        title: null,
        description: null,
    },
    getters: {
        getErrorShortDescription(state) {
            return state.short_description
        },
        getErrorCategoryId(state) {
            return state.category_id
        },
        getErrorPhoto(state) {
            return state.photo
        },
        getErrorTitle(state) {
            return state.title
        },
        getErrorDescription(state) {
            return state.description
        },
    }
}
