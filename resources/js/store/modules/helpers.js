export default {
    actions: {
        scrollToTop() {
            window.scrollTo(0,0);
        }
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
