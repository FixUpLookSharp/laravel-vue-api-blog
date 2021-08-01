export default {
    actions: {
        async recentPosts(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/footer/recent-posts',
            }).then((response) => {
                console.log(response.data)
                ctx.commit('SET_RECENT_POST', response.data)
            })

        },
    },
    mutations: {
        SET_RECENT_POST(state, posts) {
            state.recentPosts = posts
        },
    },
    state: {
        recentPosts: {},
    },
    getters: {
        getRecentPosts(state) {
            return state.recentPosts
        },

    }
}
