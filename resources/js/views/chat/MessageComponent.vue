<template>
    <div class="card">
<!--        card-body-->
        <div class="card-header msg_head">
            <div class="d-flex bd-highlight row">
                <div class="img_cont col-md-2">
                    <img v-if="chat.chatSubscriberPhoto" :src="'/storage/' + chat.chatSubscriberPhoto"  class="rounded-circle user_img">
                    <img v-else src="/storage/uploads/userStandart.jpg"  class="rounded-circle user_img">
                    <span v-if="chat.chatSubscriberIsOnline" class="online_icon"></span>
                    <span v-else class="online_icon offline"></span>
                </div>
                <div class="user_info col-md-6">
                    <span>{{ chat.chatSubscriberName }}</span>
                    <p>Сообщений: {{ chat.chatSubscriberCountMessage }}</p>
                </div>
                <div v-if="!chat.chatSubscriberIsOnline" class="user_info col-md-4 mt-4">
                    {{ chat.chatWasOnline }}
                </div>
            </div>
            <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
            <div class="action_menu">
                <ul>
                    <li><i class="fas fa-user-circle"></i><a style="color: white; text-decoration: none;" :href="chat['routeAccounShow']">Просмотреть профиль</a></li>
                    <li><i class="fas fa-users"></i>  Добавить в близкие друзья</li>
                    <li><i class="fas fa-plus"></i>  Добавить в группу</li>
                    <li><i class="fas fa-ban"></i> Блокировать</li>
                </ul>
            </div>
        </div>
        <div id="scrollbar" class="card-body msg_card_body">
            <div v-for="message in messages">
                <div  v-if="chat.authUser == message.itemRecepientId" class="d-flex justify-content-start mb-4">
                    <div class="img_cont_msg">
                        <img v-if="message.itemAuthorPhoto" :src="'/storage/' + message.itemAuthorPhoto" class="rounded-circle user_img_msg">
                        <img v-else src="/storage/uploads/userStandart.jpg" class="rounded-circle user_img_msg">
                    </div>
                    <div class="msg_cotainer">
                        {{ message.itemMessage }}
                        <span class="msg_time">{{ message.itemCreatedAtFormat }}</span>
                    </div>
                </div>
                <div v-else class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send" style="min-width: 50px!important;">
                        {{ message.itemMessage }}
                        <span class="msg_time_send">{{ message.itemCreatedAtFormat }}</span>
                    </div>
                    <img v-if="message.itemAuthorPhoto" :src="'/storage/' + message.itemAuthorPhoto" class="rounded-circle user_img_msg">
                    <img v-else src="/storage/uploads/userStandart.jpg" class="rounded-circle user_img_msg">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                </div>
                <input @keyup.enter="sendMessage(chat.routeSubscriber, chat.chatId)" type="text" v-model="textMessages" placeholder="Напишите сообщение"  class="form-control rounded-0 border-0 py-4 bg-light">
                <div class="input-group-append">
                    <button type="submit"  @click="sendMessage" class="btn btn-link">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                textMessages: '',
            }
        },
        props: [
            'messages', 'chat', 'channel', 'user',
        ],
       created() {
            // $('#scrollbar').scrollTop($('#scrollbar')[0].scrollHeight);
            // $(document).on("click", "#action_menu_btn", function() {
            //     $('.action_menu').toggle();
            // });
            var app = this;
            var socket = io('http://192.168.10.10:3000');

            socket.on("news-action." + this.user + ":App\\Events\\PrivateMessage", function (data) {
                app.messages.push(data.message);
            }.bind(this));
        },
        methods: {
            async sendMessage() {
                $('#scrollbar').scrollTop($('#scrollbar')[0].scrollHeight);
                await axios({
                    method: 'post',
                    url: '/api/V1/chat/message/' + this.chat.chatSubscriberId,
                    data: {
                        message: this.textMessages,
                        chatId: this.chat.chatId,
                        channel: this.channel,
                    }
                }).then((response) => {
                    this.authUser = response.data.authUserId;
                    this.messages.push(response.data);
                    console.log(response.data)
                    console.log(response.data.authUserId)
                });

                this.chat.chatSubscriberCountMessage++
                this.textMessages = '';
            }
        }
    }
</script>



<style scoped>
    /*.card-body{*/
    /*    height: 100%;*/
    /*    margin: 0;*/
    /*    !*background: #7F7FD5;*!*/
    /*    !*background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);*!*/
    /*    !*background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);*!*/
    /*}*/

    /*.card{*/
    /*    height: 700px;*/
    /*    border-radius: 15px !important;*/
    /*    background-color: rgba(0,0,0,0.4) !important;*/
    /*}*/
    .msg_card_body{
        overflow-y: auto;
        background: url("/images/chat/fon_message4.jpg") no-repeat;
    }
    .card-header{
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 0 !important;
        background-color: rgb(18 140 126);
    }
    .card-footer{
        border-radius: 0 0 15px 15px !important;
        border-top: 0 !important;
        background-color: white;
    }
    .attach_btn{
        border-radius: 15px 0 0 15px !important;
        background-color: rgb(18 140 126) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .contacts li{
        width: 100% !important;
        padding: 5px 10px;
        margin-bottom: 15px !important;
    }
    .user_img{
        height: 70px;
        width: 70px;
        border:1.5px solid #f5f6fa;

    }
    .user_img_msg{
        height: 40px;
        width: 40px;
        border:1.5px solid #f5f6fa;

    }
    .img_cont{
        position: relative;
        height: 70px;
        width: 70px;
    }
    .img_cont_msg{
        height: 40px;
        width: 40px;
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
        /*margin-top: auto;*/
        /*margin-bottom: auto;*/
        /*margin-left: 15px;*/
        padding-left: 5px;
        padding-right: 5px;
    }
    .user_info span{
        font-size: 20px;
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
    .msg_cotainer{
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 10px;
        border-radius: 25px;
        background-color: #82ccdd;
        padding: 10px;
        position: relative;
    }
    .msg_cotainer_send{
        margin-top: auto;
        margin-bottom: auto;
        margin-right: 10px;
        border-radius: 25px;
        background-color: #78e08f;
        padding: 10px;
        position: relative;
    }
    .msg_time{
        position: absolute;
        left: 0;
        bottom: -25px;
        /*color: rgba(255,255,255,0.5);*/
        font-size: 10px;
    }
    .msg_time_send{
        position: absolute;
        right:0;
        bottom: -25px;
        /*color: rgba(255,255,255,0.5);*/
        font-size: 10px;
    }
    .msg_head{
        position: relative;
    }
    #action_menu_btn{
        position: absolute;
        right: 10px;
        top: 10px;
        color: white;
        cursor: pointer;
        font-size: 20px;
    }
    .action_menu{
        z-index: 1;
        position: absolute;
        padding: 15px 0;
        background-color: rgba(0,0,0,0.5);
        color: white;
        border-radius: 15px;
        top: 30px;
        right: 15px;
        display: none;
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
