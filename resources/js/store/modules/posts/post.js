import router from "../../../router";

export default {
    actions: {
        async showPost(ctx, title) {
           await axios({
               method: 'get',
               url: '/api/V1/article/' + title,
           }).then((response) => {
               ctx.commit('updatePost', response.data)

           }).catch(err => {
               ctx.commit('updatePost', false)
               router.push('/')
           })
        },

        async setLike(ctx, article) {
            await axios({
                method: 'post',
                url: '/api/V1/like/' + article
            }).then((response) => {
                ctx.commit('updateLike', response.data)
            })
        },

        async getLike(ctx, article) {
            await axios({
                method: 'get',
                url: '/api/V1/like/' + article
            }).then((response) => {
                ctx.commit('updateLikeStatus', response.data)
            })
        }
    },
    mutations: {
        updatePost(state, post) {
            state.post = post
        },
        updateLike(state, data) {
            state.post.likes_count = data.likes_count
            state.statusLike = data.status
        },
        updateLikeStatus(state, data) {
            state.statusLike = data
        }

    },
    state: {
        post: false,
        statusLike: false
    },
    getters: {
        getPost(state) {
            return state.post
        },
        getStatusLike(state) {
            return state.statusLike
        }
    }
}
