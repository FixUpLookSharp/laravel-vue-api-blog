export default {
    actions: {
        async fetch(ctx, data) {
            await axios({
                method: 'get',
                url: data.url,
                params: {
                    search: data.searchData,
                },
            }).then((response) => {
                if (response.data.length == 0) {
                    ctx.commit('updateNotFoundSearch', true)
                } else {
                    ctx.commit('updateNotFoundSearch', false)
                }
                ctx.commit('updateSearchData', response.data)
                ctx.commit('updateSearchStatus', true)
            });
        },
        updateFetch(ctx) {
            ctx.commit('updateSearchData', null)
            ctx.commit('updateNotFoundSearch', false)
            ctx.commit('updateSearchStatus', false)
        }
    },
    mutations: {
        updateNotFoundSearch(state, status) {
            state.notFoundSearch = status
        },
        updateSearchStatus(state, status) {
            state.searchStatus = status
        },
        updateSearchData(state, data) {
            state.searchData = data
        }
    },
    strict: true,
    state: {
        notFoundSearch: false,
        searchStatus: false,
        searchData: null,
    },
    getters: {
        getSearchStatus(state) {
            return state.searchStatus
        },
        getNotFoundStatus(state) {
            return state.notFoundSearch
        },
        getSearchData(state) {
            return state.searchData
        }
    }
}
