export default {
    actions: {
        async linkActive(ctx, link) {
            let links = {
                linkSettings: false,
                linkPassword: false,
                linkUserPosts: false,

            }

            if (link == 'settings') {
                links.linkSettings = true
                links.linkUserPosts = false
                links.linkPassword = false
                ctx.commit('updateLinksSettings', links)
            } else if (link == 'password') {
                links.linkPassword = true
                links.linkSettings = false
                links.linkUserPosts = false
                ctx.commit('updateLinksSettings', links)
            } else if (link == 'userPosts') {
                links.linkPassword = false
                links.linkSettings = false
                links.linkUserPosts = true
                ctx.commit('updateLinksSettings', links)
            }
        }
    },
    mutations: {
        updateLinksSettings(state, links) {
            state.links = links
        },
    },
    state: {
        links: {
            linkSettings: false,
            linkPassword: false,
            linkUserPosts: false,
        }
    },
    getters: {
        getLinksSettings(state) {
            return state.links
        },
    }
}
