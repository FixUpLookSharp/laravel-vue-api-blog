
export default {
    actions: {
        async changePassword(ctx, data) {
           axios({
               method: 'post',
               url: '/api/V1/user/change-password',
               data: {
                   password: data.password,
                   old_password: data.old_password,
                   password_confirmation: data.password_confirmation
               }
           }).then((response) => {
               console.log(response.data)
           }).catch(error => {
               console.log(error.response.data)
               let errors = {}
               errors.old_password = error.response.data.errors.old_password ? error.response.data.errors.old_password[0] : null
               errors.password = error.response.data.errors.password ? error.response.data.errors.password[0] : null
               errors.bigLatters = error.response.data.errors.bigLatters ? error.response.data.errors.bigLatters : null
               errors.numbers = error.response.data.errors.numbers ? error.response.data.errors.numbers : null
               errors.smallLetters = error.response.data.errors.smallLetters ? error.response.data.errors.smallLetters : null
               errors.symbols = error.response.data.errors.symbols ? error.response.data.errors.symbols : null

            ctx.commit('updateErrorsUser', errors)
           })
        }
    },
    mutations: {
        updateErrorsUser(state, errors) {
            return state.errors = errors
        }
    },
    state: {
        errors: null,
    },
    getters: {
        getErrorsUser(state) {
            return state.errors
        }
    }
}
