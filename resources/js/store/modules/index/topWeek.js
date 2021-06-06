export default {
    actions: {
        async topWeekPost(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/index/top-week'
            }).then((response) => {
                ctx.commit('SET_TOP_WEEK_POST', response.data)
            })
        },
    },
    mutations: {
        SET_TOP_WEEK_POST(state, post) {
            state.topWeekPost = post
        },
    },
    state: {
        topWeekPost: null,
    },
    getters: {
        getTopWeekPost(state) {
            return state.topWeekPost
        },
    }
}
