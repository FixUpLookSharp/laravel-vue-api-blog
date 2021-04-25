import router from "../../../router";
export default {
    actions: {
       async registerUser(ctx, data) {
           let errors = { email: null, password: null, error: null }
           await ctx.commit("updateRegisterErrors", errors)
           await  axios({
                method: 'post',
                url: 'api/auth/register',
                data: {
                    name: data.name,
                    email: data.email,
                    password: data.password,
                    password_confirmation: data.password_confirmation,
                }
            }).then((response) => {
                ctx.dispatch('attemptUser', response.data.token.original.token)
                router.push('/')
            }).catch(error => {
               let errors = {}
               errors.name = error.response.data[0].name ? error.response.data[0].name[0] : null
               errors.email = error.response.data[0].email ? error.response.data[0].email[0] : null
               errors.password = error.response.data[0].password ? error.response.data[0].password[0] : null
                ctx.commit("updateRegisterErrors", errors)
            })
        }
    },
    mutations: {
        updateRegisterErrors(state, errors) {
            state.errors = errors
        }
    },
    state: {
        errors: {
            name: null,
            email: null,
            password: null,
        },

    },
    getters: {
        getRegisterErrors(state) {
            return state.errors
        }
    }
}
