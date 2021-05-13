import router from "../../../router";
export default {
    actions: {
        async attemptUser(ctx, token) {  // Accepts a token from registration and login
            if (token) {
                ctx.commit('SET_LINK', 'main')
                ctx.commit('SET_TOKEN', token)
            }
            if (!ctx.state.token) { // If the user is not logged in, stop the code
                return
            }
            try {
               await axios({  // Get an authorized user
                    method: 'get',
                    url: '/api/auth/profile'
                }).then((response) => {
                    ctx.commit('SET_USER', response.data) // User commit
                })
            } catch (e) {  // If there is an error, we reset the token and the user
                ctx.commit('SET_TOKEN', null)
                ctx.commit('SET_USER', null)
            }
        },

        async logout(ctx) {
          await axios({
              method: 'post',
              url: '/api/auth/logout',
          }).then((response) => {
              axios.defaults.headers.common['Authorization'] = null
              localStorage.removeItem('link')
              ctx.commit('SET_LINK', null)
              localStorage.removeItem('token')
              ctx.commit('SET_TOKEN', null)
              ctx.commit('SET_USER', null)
              router.push('/login')
          })

        },

    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token
        },
        SET_USER(state, user) {
            state.auth = user
        }
    },
    state: {
        auth: null,
        token: null,
    },
    getters: {
        getAuthStatus(state) {
            return state.auth && state.token
        },

        getAuth(state) {
            return state.auth
        }
    }
}
