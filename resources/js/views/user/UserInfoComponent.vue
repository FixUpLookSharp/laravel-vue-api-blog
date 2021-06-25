<template>
    <div v-if="userInfo" class="container">
        <div class="main-body">
            <div class="row">
                <user-left-block-component :user="userInfo"></user-left-block-component>
                <div class="col-lg-8">
                    <div class="card">
                        <user-right-block-component :user="userInfo"></user-right-block-component>
                    </div>
                    <div class="row">
                        <user-right-down-component :user="userInfo"></user-right-down-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions }  from 'vuex'
    import UserLeftBlockComponent from "./UserLeftBlockComponent";
    import UserRightBlockComponent from "./UserRightBlockComponent";
    import UserRightDownComponent from "./UserRightDownComponent";
    export default {
        components: {
            UserLeftBlockComponent,
            UserRightBlockComponent,
            UserRightDownComponent
        },
        computed: {
          ...mapGetters({
              userInfo: 'getUserInfo'
          })
        },
         mounted() {
            this.getUserInfo(this.$route.params.id)
        },
        methods: {
            ...mapActions({
                getUserInfo: 'getUserInfo',
            })
        }
    }
</script>

<style scoped>
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }
    .me-2 {
        margin-right: .5rem!important;
    }
    .main-body {
        padding-top: 20px;
        padding-bottom: 20px;
    }
</style>
