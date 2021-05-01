import router from "../../../router";

export default {
    actions: {
       async loginSubmit(ctx, data) {
           let errors = { email: null, password: null, error: null }
          await ctx.commit("updateLoginErrors", errors)
            await axios({
                method: 'post',
                url: '/api/auth/login',
                data: {
                    email: data.email,
                    password: data.password,
                    remember: data.remember,
                }
            }).then((response) => {
                ctx.dispatch('attemptUser', response.data.token)
                router.push('/')
            }).catch(error => {
                let errors = {}
                errors.email = error.response.data.email ? error.response.data.email[0] : null
                errors.password = error.response.data.password ? error.response.data.password[0] : null
                errors.error = error.response.data.error ? error.response.data.error : null
                ctx.commit("updateLoginErrors", errors)
            })
        }
    },
    mutations: {
        updateLoginErrors(state, errors) {
            state.errors = errors
        }
    },
    state: {
        errors: {
            email: null,
            password: null,
            error: null,
        }
    },
    getters: {
        getErrorLogin(state) {
            return state.errors
        }
    }
}
