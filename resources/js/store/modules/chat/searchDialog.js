import router from "../../../router";

export default {
    actions: {
        async searchDialog(ctx, obj) {
            ctx.commit('updateSearchActiveDialogId', obj.dialogId)
            await axios({
                method: 'post',
                url: '/api/V1/chat/store/' + obj.dialogId,
            }).then((response) =>{
                ctx.commit('updateSearchDialogId', response.data)
                if (ctx.getters.getSearchStatus) {
                    if (ctx.getters.getDialogId != response.data) {
                        router.push({name: 'chat', params: {chat: response.data}})
                    }
                }
            })

            await axios({
                method: 'post',
                url: '/api/V1/chat/' + ctx.getters.getSearchDialogId,
            }).then((response) => {
                console.log(response.data)

                ctx.commit('updateMessage', response.data.messageAll)
                ctx.commit('updateChat', response.data.chat)
                ctx.commit('updateStatus', true)
                ctx.commit('updateDialogId', response.data.chat['chatId'])
                ctx.commit('updateChannel', 'news-action.' + response.data.chat['chatSubscriberId'])
                ctx.commit('updateUser', response.data.chat['authUser'])
            });
        },
    },
    mutations: {
        updateSearchActiveDialogId(state, dialogId) {
            state.dialogActiveId = dialogId
        },
        updateSearchDialogId(state, dialogId) {
            state.dialogSearchId = dialogId
        },

    },
    strict: true,
    state: {
        dialogActiveId: 0,
        dialogSearchId: 0,
        dialogMessage: [],


    },
    getters: {
        getSearchActiveDialogId(state) {
            return state.dialogActiveId
        },
        getSearchDialogId(state) {
            return state.dialogSearchId
        }
    }
}
