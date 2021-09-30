<template>
    <div class="input-group">
        <input type="text" placeholder="Search..." v-model="searchInput" class="form-control search">
        <div class="input-group-prepend">
            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters} from 'vuex'
    import { debounce } from "../../helper";

    export default {
        data: function() {
            return {
                debounceSearch: null,
                searchInput: '',
            }
        },
        watch: {
            searchInput: debounce(function (newVal) {
                this.debounceSearch = newVal;
            }, 300),
            debounceSearch(after, before) {
                if (this.debounceSearch) {
                    this.fetch({searchData: this.debounceSearch, url: '/api/V1/chat/search'});
                }
                if (!this.debounceSearch) {
                    this.updateFetch()
                }
            }
        },
        methods:{
            ...mapActions({
                fetch: 'fetch',
                updateFetch: 'updateFetch'
            })
        }
    }
</script>



<style scoped>
    .search{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color:white !important;
    }
    .search:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .active-chat{
        background-color: rgba(0,0,0,0.3);
    }
    .search_btn{
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .contacts li{
        width: 100% !important;
        padding: 5px 10px;
        margin-bottom: 15px !important;
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
