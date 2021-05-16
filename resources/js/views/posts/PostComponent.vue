<template>
    <div class="site-section py-lg">
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-12 main-content">
                <img :src="prefixUrlPhoto + post.photo" alt="Image" class="img-fluid mb-5">
                <div class="post-meta">
                    <span v-if="post.creator"  class="author mr-2">
                        <img :src="prefixUrlPhoto + post.creator.photo" class="mr-2"> {{ post.creator.name }}
                    </span>&bullet;
                    <span class="mr-2">{{ moment(post.created_at).format("DD MM YYYY") }}</span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span>
                </div>
                <h1 class="mb-4">{{ post.title }}</h1>
                <a class="category mb-5" href="#">{{ $t(post.category_name) }}</a>
                <div class="post-content-body">
                    <vue-markdown :source="post.description"></vue-markdown>
                </div>
                <div class="row block-test">
                    <div class="col-md-12 mt-5 text-right">
                        <span @click="setLike(post.id)" class="ml-4 likeBlock"><span :class="[statusLike ? 'likeRed' : '']" class="fa fa-lg fa-thumbs-up mr-2"></span> {{ post.likes_count }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentComponent from "./CommentComponent";
    import {mapActions, mapGetters} from 'vuex'
    import moment from "moment";
    import VueMarkdown from 'vue-markdown'
    import post from "../../store/modules/posts/post";
    export default {
        components: {CommentComponent, VueMarkdown},
        data() {
            return {
                moment: moment,
            }
        },
        computed: {
            ...mapGetters({
                post: 'getPost',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
                statusLike: 'getStatusLike',
            })
        },
        created() {
            this.showPost(this.$route.params.id)
            this.getLike(this.$route.params.id)
        },
        methods: {
            ...mapActions({
                showPost: 'showPost',
                setLike: 'setLike',
                getLike: 'getLike',

            }),
        },
    }
</script>

<style scoped>
.likeBlock {
    color: #b3b3b3;
    border: 1px solid #6f6c6c;
    border-radius: 20px;
    padding: 10px 20px;
    cursor: pointer;
}
    .likeRed {
        color: #08e59f;
    }
    .block-test {
        max-height: 80px;
    }
</style>
