export default {
    actions: {
        async allPosts(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/article'
            }).then((response) => {
                console.log(response.data)
                let pagination = {}
                // pagination.current_page = response.data.current_page
                // pagination.last_page = response.data.last_page
                // pagination.per_page = response.data.per_page
                pagination.links = response.data.links
                // pagination.next_page_url = response.data.next_page_url
                // pagination.prev_page_url = response.data.prev_page_url


                ctx.commit('SET_POSTS', response.data.data)
                ctx.commit('SET_PAGINATION', pagination)

            }).catch(err => {

            })
        }
    },
    mutations: {
        SET_POSTS(state, posts) {
            state.posts = posts
        },
        SET_PAGINATION(state, pagination) {
            state.pagination = pagination
        }
    },
    state: {
        posts: null,
        pagination: null,
    },
    getters: {
        getPosts(state) {
            return state.posts
        },
        getPagination(state) {
            return state.pagination
        }
    }
}
