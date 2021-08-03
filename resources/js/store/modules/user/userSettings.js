export default {
    actions: {
        async linkActive(ctx, link) {
            let links = {
                linkSettings: false,
                linkPassword: false,
            }

            if (link == 'settings') {
                links.linkSettings = true
                links.linkPassword = false
                ctx.commit('updateLinksSettings', links)
            } else if (link == 'password') {
                links.linkSettings = false
                links.linkPassword = true
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
        }
    },
    getters: {
        getLinksSettings(state) {
            return state.links
        },
    }
}
