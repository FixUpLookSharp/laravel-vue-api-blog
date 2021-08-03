export default {
    actions: {
        async recentPosts(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/footer/recent-posts',
            }).then((response) => {
                ctx.commit('SET_RECENT_POST', response.data)
            })
        },
        async topAllTime(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/footer/top-all-time',
            }).then((response) => {
                ctx.commit('SET_TOP_ALL_TIME', response.data)
            })
        },
    },
    mutations: {
        SET_RECENT_POST(state, posts) {
            state.recentPosts = posts
        },
        SET_TOP_ALL_TIME(state, post) {
            state.topAllTime = post
        },
    },
    state: {
        recentPosts: {},
        topAllTime: {},
    },
    getters: {
        getRecentPosts(state) {
            return state.recentPosts
        },
        getTopAllTime(state) {
            return state.topAllTime
        },

    }
}
