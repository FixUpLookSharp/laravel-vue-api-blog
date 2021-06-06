export default {
    actions: {
        async randomPosts(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/index/random-post'
            }).then((response) => {
                ctx.commit('SET_RANDOM_POSTS', response.data)
            })
        },
    },
    mutations: {
        SET_RANDOM_POSTS(state, posts) {
            state.randomPosts = posts
        },
    },
    state: {
        randomPosts: null,
    },
    getters: {
        getRandomPosts(state) {
            return state.randomPosts
        },
    }
}
