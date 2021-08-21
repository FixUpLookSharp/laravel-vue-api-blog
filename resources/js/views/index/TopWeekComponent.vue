<template>
    <div  v-if="post" class="sidebar-box">
        <div class="text-center" style="margin-bottom: 50px">
            <h2>{{ post.topWeekTitle }}</h2>
        </div>
        <div class="bio text-center">
            <img :src="prefixUrlPhoto + post.topWeek.user_photo"  class="rounded-circle" alt="user" width="100" height="100">
            <div class="bio-body">
                <h2>{{ post.topWeek.user_name }}</h2>
                <p>{{ post.topWeek.article_title }}</p>
                <p><router-link @click.native="scrollToTop" :to="{name: 'post', params:{ id: post.topWeek.article_dir}}" class="btn btn-primary btn-sm rounded">Перейти к посту</router-link></p>
                <p class="social">
                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import { mapGetters, mapActions,} from 'vuex'
    export default {
        data: function () {
            return {
                moment: moment,
            }
        },
        computed: {
            ...mapGetters({
                post: 'getTopWeekPost',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
        created() {
            this.topWeekPost()
        },
        methods: {
            ...mapActions({
                topWeekPost: 'topWeekPost',
                scrollToTop: 'scrollToTop',
            }),
        }
    }
</script>

<style scoped>

</style>
