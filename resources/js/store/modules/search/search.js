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
                console.log(response.data)
                if (response.data.length == 0) {
                    ctx.commit('updateNotFoundSearch', true)
                } else {
                    ctx.commit('updateNotFoundSearch', false)
                }
                ctx.commit('updateSearchData', response.data)
                // ctx.commit('updateSearchInput', data.searchData)
                ctx.commit('updateSearchStatus', true)
            });
        },
        updateFetch(ctx) {
            ctx.commit('updateSearchData', null)
            // ctx.commit('updateSearchInput', '')
            ctx.commit('updateNotFoundSearch', false)
            ctx.commit('updateSearchStatus', false)
        }
    },
    mutations: {
        // updateSearchInput(state, input) {
        //     state.searchInput = input
        // },
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
        // searchInput: '',
        notFoundSearch: false,
        searchStatus: false,
        searchData: null,
    },
    getters: {
        // getSearchInput(state) {
        //     return state.searchInput
        // },
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
