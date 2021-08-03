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
           })
            console.log(data)
        }
    },
    mutations: {

    },
    state: {

    },
    getters: {

    }
}
