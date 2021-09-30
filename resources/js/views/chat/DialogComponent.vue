<template>
    <ul class="contacts">
        <li v-for="dialog in allDialog" :key="dialog.router" :class="[getDialogId == dialog.id ? 'active-chat' : '' ]" class="person" @click="showDialog({dialogId: dialog.id, url: dialog.url, channel: 'news-action.' + dialog.subscriberId, user: dialog.auth})">
            <router-link style="text-decoration: none"  :to="{ name: 'chat', params: { chat: dialog.id }}">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <img :src="'/storage/' + dialog.subscriberPhoto"  class="rounded-circle user_img">
                        <span v-if="dialog.subscriberIsOnline" class="online_icon"></span>
                        <span v-else class="online_icon offline"></span>
                    </div>
                    <div class="user_info">
                        <span>{{ dialog.subscriberName}}</span>
                        <p v-if="dialog.subscriberIsOnline">{{ dialog.subscriberName }}: в сети</p>
                        <p v-else>{{ dialog.subscriberName }}: оффлайн</p>
                    </div>
                </div>
            </router-link>
        </li>
    </ul>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    export default {
        computed: mapGetters(['allDialog', 'getDialogId',]),
        mounted() {
            if (this.$route.params.chat) {
                this.loadMessage('/api/V1/chat/' + this.$route.params.chat);
            }
            this.dialogAjax(this.$route.params.chat);
        },
        methods: {
            ...mapActions({
                dialogAjax: 'dialogAjax',
                showDialog: 'showDialog',
                loadMessage: 'loadMessage'
            })
        }
    }

</script>



<style scoped>
    .contacts{
        list-style: none;
        padding: 0;
    }
    .contacts li{
        width: 100% !important;
        padding: 5px 10px;
        margin-bottom: 15px !important;
    }
    .active-chat{
        background-color: rgba(0,0,0,0.3);
    }
    .user_img{
        height: 50px;
        width: 50px;
        border:1.5px solid #f5f6fa;

    }
    .img_cont{
        position: relative;
        height: 70px;
        width: 70px;
    }
    .online_icon{
        position: absolute;
        height: 15px;
        width:15px;
        background-color: #4cd137;
        border-radius: 50%;
        bottom: 0.2em;
        right: 0.4em;
        border:1.5px solid white;
    }
    .offline{
        background-color: #c23616 !important;
    }
    .user_info{
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 0;
    }
    .user_info span{
        font-size: 15px;
        color: white;
    }
    .user_info p{
        font-size: 10px;
        color: rgba(255,255,255,0.6);
    }
    .video_cam span{
        color: white;
        font-size: 20px;
        cursor: pointer;
        margin-right: 20px;
    }
    .action_menu ul{
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .action_menu ul li{
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 5px;
    }
    .action_menu ul li i{
        padding-right: 10px;

    }
    .action_menu ul li:hover{
        cursor: pointer;
        background-color: rgba(0,0,0,0.2);
    }
</style>
