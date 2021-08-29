export default {
    actions: {
        async notFound(ctx, view) {
          await ctx.commit('updateViewFoundStatus', view)
        }
    },
    mutations: {
        updateViewFoundStatus(state, view) {
            return state.view = view
        },
    },
    state: {
        view: true
    },
    getters: {
        getView(state) {
            return state.view
        }
    }
}
