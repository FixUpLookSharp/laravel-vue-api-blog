export default {
    actions: {
        async categoryAll(ctx) {
            await axios({
                method: 'get',
                url: 'api/V1/category'
            }).then((response) => {
                console.log(response.data)
                ctx.commit('SET_CATEGORY', response.data)
            })
        }
    },
    mutations: {
        SET_CATEGORY(state, categories) {
            state.categories = categories
        }
    },
    state: {
        categories: null
    },
    getters: {
        getCategories(state) {
           return state.categories
        }
    }
}
