export default {
    actions: {
       async getUrl(ctx, data) {
           await ctx.commit('updateSearchPlaceholder', data.placeholder)
           await ctx.commit('updateSearchUrl', data.url)
        },
    },
    mutations: {
        updateSearchPlaceholder(state, placeholder) {
            state.placeholder = placeholder
        },
        updateSearchUrl(state, url) {
            state.url = url
        },
    },
    state: {
        placeholder: '',
        url: '',
    },
    getters: {
        getSearchPlaceholder(state) {
            return state.placeholder
        },
        getSearchUrl(state) {
            return state.url
        },
    }
}
