<template>
    <div class="sidebar-box">
        <h3 class="heading">Популярные посты</h3>
        <div class="post-entry-sidebar">
            <ul>
                <li v-for="post in posts" :key="post.id">
                    <router-link @click.native="scrollToTop" class="postIndex" :to="{name: 'post', params:{ id: post.dir}}" >
                        <img :src="prefixUrlPhoto + post.photo" alt="Image placeholder" class="mr-4">
                        <div class="text">
                            <h4>{{ post.title }}</h4>
                            <div class="post-meta">
                                <span class="mr-2">{{ moment(post.created_at).format('DD.MM.YYYY') }}</span>
                            </div>
                        </div>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import moment from "moment";
    export default {
        data() {
            return {
                moment: moment,
            }
        },
        computed: {
            ...mapGetters({
                posts: 'getTopPosts',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
        created() {
            this.topPosts()
        },
        methods: {
            ...mapActions({
                topPosts: 'topPosts',
                scrollToTop: 'scrollToTop',
            }),
        }
    }
</script>

<style scoped>
    .postIndex {
        text-decoration: none;
        color: black;
    }
</style>
