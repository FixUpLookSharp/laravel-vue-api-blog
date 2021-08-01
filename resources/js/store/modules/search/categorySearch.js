export default {
    actions: {
       async getUrl(ctx, data) {
           await ctx.commit('updateSearchPlaceholder', data.placeholder)
           await ctx.commit('updateSearchUrl', data.url)
           await ctx.commit('updateSearchPath', data.path)

        },
    },
    mutations: {
        updateSearchPlaceholder(state, placeholder) {
            state.placeholder = placeholder
        },
        updateSearchUrl(state, url) {
            state.url = url
        },
        updateSearchPath(state, path) {
            state.path = path
        }
    },
    state: {
        placeholder: '',
        url: '',
        path: ''
    },
    getters: {
        getSearchPlaceholder(state) {
            return state.placeholder
        },
        getSearchUrl(state) {
            return state.url
        },
        getSearchPath(state) {
            return state.path
        },
    }
}
