export default {
    actions: {
        mainActiveLink(ctx, link) {
            localStorage.setItem('link', link);
            let newLink = localStorage.getItem('link')
            ctx.commit('SET_LINK', newLink)
        }
    },
    mutations: {
        SET_LINK(state, status) {
            state.mainLink = status
        }
    },
    state: {
        mainLink: null,
    },
    getters: {
        getMainLink(state) {
            return state.mainLink
        },
    }
}
