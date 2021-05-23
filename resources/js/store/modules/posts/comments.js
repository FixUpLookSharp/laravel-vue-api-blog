import router from "../../../router";

export default {
    actions: {
        async showComments(ctx, dir) {
            await axios({
                method: 'get',
                url: '/api/V1/comment/' + dir,
            }).then((response) => {
                ctx.commit('updateComments', response.data)
            })
        },
    },
    mutations: {
        updateComments(state, comments) {
            state.comments = comments
        }
    },
    state: {
        comments: {}
    },
    getters: {
        getComments(state) {
            return state.comments
        }
    }
}
