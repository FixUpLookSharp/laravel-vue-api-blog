import router from "../../../router";

export default {
    actions: {
        async dialogAjax(ctx) {
            await axios({
                method: 'get',
                url: '/api/V1/chat/dialogs',
            }).then((response) => {
                console.log(response.data)
                ctx.commit('updateDialogs', response.data);
            }).catch(error => console.log(error.response.data )) ;
        },

        async showDialog(ctx, obj) {
            ctx.commit('updateDialogId', obj.dialogId)
            ctx.commit('updateChannel', obj.channel)
            ctx.commit('updateUser', obj.user)
            await axios({
                method: 'post',
                url: obj.url,
            }).then((response) => {
                console.log(response.data)
                ctx.commit('updateMessage', response.data.messageAll)
                ctx.commit('updateChat', response.data.chat)
                ctx.commit('updateStatus', true)
            });
        },
        async loadMessage(ctx, url) {
            await axios({
                method: 'post',
                url: url,
            }).then((response) => {
                if(response.data['dialogs'] == false) {
                    // router.push({name: 'chat-all'})
                    return;
                }
                ctx.commit('updateMessage', response.data.messageAll)
                ctx.commit('updateChat', response.data.chat)
                ctx.commit('updateStatus', true)
                ctx.commit('updateDialogId', response.data.chat['chatId'])
                ctx.commit('updateChannel', 'news-action.' + response.data.chat['chatSubscriberId'])
                ctx.commit('updateUser', response.data.chat['authUser'])

            })
        },
    },
    mutations: {
        updateDialogs(state, dialog) {
            state.dialogs = dialog
        },
        updateMessage(state, message) {
            state.messages = message
        },
        updateChat(state, chat) {
            state.chat = chat
        },
        updateStatus(state, status) {
            state.status = status
        },
        updateDialogId(state, dialogId) {
            state.dialogId = dialogId
        },
        updateChannel(state, channel) {
            state.channel = channel
        },
        updateUser(state, user) {
            state.user = user
        }
    },
    state: {
        dialogs: [],
        messages: [],
        chat: [],
        dialogId: 0,
        status: false,
        channel: [],
        user: 0,
    },
    getters: {
        allDialog(state) {
            return state.dialogs
        },
        allMessages(state) {
            return state.messages
        },
        getChat(state) {
            return state.chat
        },
        getDialogId(state) {
            return state.dialogId
        },
        getStatus(state) {
            return state.status
        },
        getChannel(state) {
            return state.channel
        },
        getUser(state) {
            return state.user
        },
    }
    ,
}
