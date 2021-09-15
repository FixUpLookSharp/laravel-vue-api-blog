export default {
    actions: {
        scrollToTop() {
            window.scrollTo(0,0);
        },
        checkPassword(ctx, password) {
            let s_letters = "qwertyuiopasdfghjklzxcvbnm"
            let b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNM"
            let digits = "0123456789"
            let specials = "!@#$%^&*()_-+=\|/.,:;[]{}"

            let is_s = false
            let is_b = false
            let is_d = false
            let is_sp = false

            for (let i = 0; i < password.length; i++) {
                if (!is_s && s_letters.indexOf(password[i]) != -1) is_s = true
                else if (!is_b && b_letters.indexOf(password[i]) != -1) is_b = true
                else if (!is_d && digits.indexOf(password[i]) != -1) is_d = true
                else if (!is_sp && specials.indexOf(password[i]) != -1) is_sp = true
            }
            let rating = 0
            let text = ""
            if (is_s) rating++
            if (is_b) rating++
            if (is_d) rating++
            if (is_sp) rating++

            if (password.length < 6 && rating < 3) text = "Простой"
            else if (password.length < 6 && rating >= 3) text = "Средний"
            else if (password.length >= 8 && rating < 3) text = "Средний"
            else if (password.length >= 8 && rating >= 3) text = "Сложный"
            else if (password.length >= 6 && rating == 1) text = "Простой"
            else if (password.length >= 6 && rating > 1 && rating < 4) text = "Средний"
            else if (password.length >= 6 && rating == 4) text = "Сложный"

            let data = {
                status: true,
                password: text,
                color: '',
            }

            if (text == "Простой") data.color = "badge-danger"
            else if (text == "Средний") data.color = "badge-warning"
            else if (text == "Сложный") data.color = "badge-success"

            ctx.commit('updateComplexityPassword', data)
        }
    },
    mutations: {
        updateComplexityPassword(state, data) {
            state.complexityPassword = data
        }
    },
    state: {
        prefixUrl: 'http://newblog.test/storage/',
        complexityPassword: {
            status: false,
            password: '',
            color: '',
        }
    },
    getters: {
        getPrefixUrlPhoto(state) {
            return state.prefixUrl
        },
        getComplexityPassword(state) {
            return state.complexityPassword
        }
    }
}
