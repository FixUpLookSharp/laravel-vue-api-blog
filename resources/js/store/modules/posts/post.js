import router from "../../../router";

export default {
    actions: {
        async showPost(ctx, title)
        {
           await axios({
               method: 'get',
               url: '/api/V1/article/' + title,
           }).then((response) => {
               console.log(response.data)
               ctx.commit('updatePost', response.data)

           }).catch(err => {
               console.log(err.response.data)
                    ctx.commit('updatePost', false)
               router.push('/404')
           })

        }
    },
    mutations: {
        updatePost(state, post) {
            state.post = post
        }
    },
    state: {
       post: false,
    },
    getters: {
        getPost(state) {
            return state.post
        }
    }
}
