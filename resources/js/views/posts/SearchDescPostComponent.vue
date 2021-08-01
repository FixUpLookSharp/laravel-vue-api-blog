<template>
    <div v-if="posts">
        <div v-for="post in posts" :key="post.id" class="row mt-1">
            <div class="col-md-12">
                <div class="post-entry-horzontal">
                    <router-link class="linkRoute" :to="{name: 'post', params:{ id: post.dir}}">
                        <div class="image " data-animate-effect="fadeIn" :style="{ 'background-image': 'url(' + prefixUrlPhoto + post.photo + ')' }"></div>
                        <span class="text">
                            <div class="post-meta">
                                <span class="author mr-2"><img :src="prefixUrlPhoto + post.creator.photo"> {{ post.creator.name }}</span>&bullet;
                                <span class="mr-2">{{ moment(post.created_at).format("DD.MM.YYYY") }} </span> &bullet;
                                <span class="mr-2">{{ $t(post.category_name) }}</span> &bullet;
                                <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span>
                                <span class="ml-2"><span class="fa fa-thumbs-up"></span> {{ post.likes_count }}</span>
                            </div>
                            <span  v-html="post.title"></span>
                        </span>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";
    import {mapGetters} from 'vuex'
    export default {
        data() {
            return {
                moment: moment,
            }
        },
        mounted() {

        },
        computed: {
            ...mapGetters({
                prefixUrlPhoto: 'getPrefixUrlPhoto',
            }),
        },
        props: ['posts']
    }
</script>

<style scoped>

</style>
