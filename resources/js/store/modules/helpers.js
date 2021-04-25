export default {
    actions: {

    },
    mutations: {

    },
    state: {
        prefixUrl: 'http://newblog.test/storage/'
    },
    getters: {
        getPrefixUrlPhoto(state) {
            return state.prefixUrl
        }
    }
}
