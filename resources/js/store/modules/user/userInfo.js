export default {
    actions: {
        async getUserInfo(ctx, userId) {
            await axios({
                method: 'get',
                url: '/api/V1/account/' + userId + '/info',
            }).then((response) => {
                ctx.commit('updateUserInfo', response.data)
            })
        }
    },
    mutations: {
        updateUserInfo(state, user) {
            state.userInfo = user
        }
    },
    state: {
        userInfo: null,
    },
    getters: {
        getUserInfo(state) {
            return state.userInfo
        }
    }
}
