<template>
    <div class="row">
        <div  v-for="post in posts.data" :key="post.id" class="col-md-6">
            <div class="blog-entry">
                <router-link @click.native="scrollToTop" :to="{name: 'post', params:{ id: post.dir}}">
                    <img :src="prefixUrlPhoto + post.photo" alt="Image placeholder">
                </router-link>
                <div class="blog-content-body">
                    <div class="post-meta">
                        <span class="author mr-2"><img :src="prefixUrlPhoto + post.creator.photo" class="rounded-circle" alt="user" width="30" height="30"> {{ post.creator.name }}</span>&bullet;
                        <span class="mr-2">{{ moment(post.created_at).format("DD.MM.YYYY") }}</span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span>
                        <span class="ml-2"><span class="fa fa-thumbs-up"></span> {{ post.likes_count }}</span>

                    </div>
                    <router-link @click.native="scrollToTop" :to="{name: 'post', params:{ id: post.dir}}" class="linkRoute">
                        <h2>{{ post.title }}</h2>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    import moment from "moment";
    export default {
        data: function() {
            return {
                moment: moment,
            }
        },
        props: ['posts'],
        computed: {
            ...mapGetters({
                auth: 'getAuth',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
        methods: {
            ...mapActions({
                scrollToTop: 'scrollToTop',
            }),
        }
    }
</script>

<style scoped>

</style>
