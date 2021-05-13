<template>
    <div class="site-section py-lg">
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-12 main-content">
                <img :src="prefixUrlPhoto + post.photo" alt="Image" class="img-fluid mb-5">
                <div class="post-meta">
                    <span v-if="post.creator"  class="author mr-2"><img :src="prefixUrlPhoto + post.creator.photo" class="mr-2"> {{ post.creator.name }}</span>&bullet;
                    <span class="mr-2">{{ moment(post.created_at).format("DD MM YYYY") }}</span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span>
                    <span class="ml-4"><span @click="addLike" class="fa fa-thumbs-up"></span> {{ post.likes_count }}</span>
                </div>
                <h1 class="mb-4">{{ post.title }}</h1>
                <a class="category mb-5" href="#">{{ $t(post.category_name) }}</a>
                <div class="post-content-body">
                    <p>
                        {{ post.description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentComponent from "./CommentComponent";
    import {mapActions, mapGetters} from 'vuex'
    import moment from "moment";
    export default {
        components: {CommentComponent},
        data() {
            return {
                moment: moment,
            }
        },
        computed: {
            ...mapGetters({
                post: 'getPost',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
        created() {
            this.showPost(this.$route.params.id)
        },
        methods: {
            ...mapActions({
                showPost: 'showPost',
            }),
            addLike() {
                this.post.likes_count++
            }
        },
    }
</script>

<style scoped>

</style>
