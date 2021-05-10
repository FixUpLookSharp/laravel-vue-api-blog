export default {
    actions: {
        async topPosts(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/index/top-post'
            }).then((response) => {
                console.log(response.data)
                ctx.commit('SET_TOP_POSTS', response.data)
            })
        },
    },
    mutations: {
        SET_TOP_POSTS(state, posts) {
            state.topPosts = posts
        },
    },
    state: {
        topPosts: null,
    },
    getters: {
        getTopPosts(state) {
            return state.topPosts
        },
    }
}
