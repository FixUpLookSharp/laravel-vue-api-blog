export default {
    actions: {

    },
    mutations: {
        updateErrorCurrentPassword(state, current_password) {
            return state.current_password = current_password
        },
        updateErrorNewPassword(state, new_password) {
            return state.new_password = new_password
        },
        updateErrorNewPasswordConfirmation(state, new_password_confirmation) {
            return state.new_password_confirmation = new_password_confirmation
        }
    },
    state: {
        current_password: null,
        new_password: null,
        new_password_confirmation: null,
    },
    getters: {
        getErrorCurrentPassword(state) {
            return state.current_password
        },
        getErrorNewPassword(state) {
            return state.new_password
        },
        getErrorNewPasswordConfirmation(state) {
            return state.new_password_confirmation
        }
    }
}
