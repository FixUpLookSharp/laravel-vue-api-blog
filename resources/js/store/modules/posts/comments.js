export default {
    actions: {
        async showComments(ctx, dir) {
            await axios({
                method: 'get',
                url: '/api/V1/comment/' + dir,
            }).then((response) => {
                ctx.commit('updateComments', response.data.newComments)
                ctx.commit('updateCommentButton', response.data.loadButton)

            })
        },
    },
    mutations: {
        updateComments(state, comments) {
            state.comments = comments
        },
        updateCommentErrors(state, errors) {
            state.errors = errors
        },
        updateCommentButton(state, button) {
            state.button = button
        }
    },
    state: {
        comments: {},
        errors: null,
        button: false,
    },
    getters: {
        getComments(state) {
            return state.comments
        },
        getErrorsComments(state) {
            return state.errors
        },
        getCommentLoadButton(state) {
            return state.button
        }
    }
}
