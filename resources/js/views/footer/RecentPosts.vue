<template>
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
</template>

<script>
    import {mapGetters, mapActions} from "vuex";
    import moment from "moment";
    export default {
        data() {
            return {
                moment: moment,
            }
        },
        computed: {
            ...mapGetters({
                getAuth: 'getAuth',
                getCategories: 'getCategories',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
                posts: 'getRecentPosts',
            }),
        },
        mounted() {
            this.recentPosts()
        },
        methods: {
            ...mapActions({
                recentPosts: 'recentPosts',
                scrollToTop: 'scrollToTop',
            }),
        }
    }
</script>

<style scoped>

</style>
