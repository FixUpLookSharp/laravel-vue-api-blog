export default {
    actions: {
        async userPosts(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/user/my-posts',
            }).then((response) => {
                console.log(response.data)
                ctx.commit('updateUserPosts', response.data)
            })
        }
    },
    mutations: {
        updateUserPosts(state, posts) {
            state.userPosts = posts
        }
    },
    state: {
        userPosts: null,
    },
    getters: {
        getUserPosts(state) {
            return state.userPosts
        }
    }
}
