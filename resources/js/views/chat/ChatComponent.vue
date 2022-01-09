<template>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100 ">
            <div class="col-md-4 col-xl-4 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
<!--                    card-body-->
                    <div class="card-header">
                        <search-component></search-component>
                    </div>
                    <div class="card-body contacts_body">
                            <dialog-component v-if="!getSearchStatus"></dialog-component>
                            <search-dialog-component v-else-if="getSearchStatus"></search-dialog-component>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-8 col-xl-8 chat chat-id">
                <div id="messageCon" class="card">
<!--                    card-body card-body-content chat-temp-->
                    <message-component v-if="getStatus" :messages="allMessages" :chat="getChat" :channel="getChannel" :user="getUser"></message-component>
                    <greetings-component v-else></greetings-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MessageComponent from "./MessageComponent";
    import DialogComponent from "./DialogComponent";
    import SearchComponent from "./SearchComponent";
    import SearchDialogComponent from "./SearchDialogComponent";
    import GreetingsComponent from "./GreetingsComponent";
    import {mapGetters, mapActions, mapMutations} from 'vuex'
    export default {
        components: {MessageComponent, DialogComponent, SearchComponent, SearchDialogComponent, GreetingsComponent},
        computed: mapGetters(['getStatus', 'allMessages', 'getChat', 'getChannel', 'getUser', 'getSearchStatus', 'getSearchDialogId']),
        methods: {
            ...mapMutations({
                updateNotFoundSearch: 'updateNotFoundSearch',
                updateSearchData: 'updateSearchData',
                updateSearchStatus: 'updateSearchStatus',
            }),
        },
        async beforeRouteLeave(to, from, next) {
            this.updateNotFoundSearch(false)
            this.updateSearchData(null)
            this.updateSearchStatus(false)
            next()
        },
    }
</script>

<style scoped>
    .card-body{
        height: 100%;
        margin: 0;
    }

    .chat{
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 0!important;
    }
    .card{
        height: 715px;
        border-radius: 15px !important;
        /*background-color: rgba(0,0,0,0.4) !important;*/
        /*background-color: white!important;*/
        /*background: url("/images/chat/fon_dialog2.jpg") no-repeat;*/

    }
    .contacts_body{
        padding:  0.75rem 0 !important;
        overflow-y: auto;
        white-space: nowrap;
        background-color: whitesmoke;

        /*background: url("/images/chat/fon_dialog2.jpg") no-repeat;*/

    }
    .card-header{
        padding-top: 32px;
        padding-bottom: 25px;
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 0 !important;
        /*background-color: rgb(18 140 126);*/

    }
    .card-footer{
        padding-top: 35.5px;
        padding-bottom: 35.5px;
        border-radius: 0 0 15px 15px !important;
        border-top: 0 !important;
    }
    .contacts li{
        width: 100% !important;
        padding: 5px 10px;
        margin-bottom: 15px !important;
    }
    /*.user_info span{*/
    /*    font-size: 20px;*/
    /*    color: white;*/
    /*}*/
    /*.user_info p{*/
    /*    font-size: 10px;*/
    /*    color: rgba(255,255,255,0.6);*/
    /*}*/
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
    @media(max-width: 576px){
        .contacts_card{
            margin-bottom: 15px !important;
        }
    }
</style>
