<template>
    <section class="site-section py-lg">
        <div class="container">
            <div class="row blog-entries">
                <div v-if="searchNotFoundStatus" class="col-md-6">
                    <h2 class="mb-4">Постов не найдено </h2>
                    <button class="btn btn-outline-success" @click="backPost">К предедущему посту</button>
                </div>
                <div v-if="!searchData" class="col-md-12 col-lg-8 main-content">
                    <img :src="prefixUrlPhoto + post.photo" alt="Image" class="img-fluid mb-5">
                    <div class="post-meta">
                       <span v-if="post.creator"  class="author mr-2">
                        <img :src="prefixUrlPhoto + post.creator.photo" class="mr-2" width="150" height="30" > {{ post.creator.name }}
                    </span>&bullet;
                        <span class="mr-2">{{ moment(post.created_at).format("DD.MM.YYYY") }}</span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span> &bullet;
                        <span class="ml-2"><span class="fa fa-thumbs-up"></span> {{ post.likes_count }}</span>
                    </div>
                    <h1 class="mb-4">{{ post.title }}</h1>
                    <div class="post-content-body">
                        <vue-markdown :source="post.description"></vue-markdown>
                    </div>
                    <div v-if="authStatus" class="row block-test">
                        <div class="col-md-12 mt-5 text-right">
                            <span :class="[statusLike ? 'likeRed' : '']" @click="setLike(post.id)" class="ml-4 likeBlock"><span  class="fa fa-lg fa-thumbs-up mr-2"></span> {{ post.likes_count }}</span>
                        </div>
                    </div>
                    <comments-component :postId="post.id"></comments-component>
                </div>
                <div v-else-if="searchData" class="col-md-12 col-lg-8 main-content">
                    <button v-if="!searchNotFoundStatus" class="btn btn-outline-success mb-5" @click="backPost">К предедущему посту</button>
                    <search-desc-post-component :posts="searchData"></search-desc-post-component>
                </div>
                <div class="col-md-12 col-lg-4 sidebar">
                    <index-search-component></index-search-component>
                    <top-week-component></top-week-component>
                    <popular-post-component></popular-post-component>
                    <index-categories-component></index-categories-component>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import CommentsComponent from "./CommentsComponent";
    import IndexCategoriesComponent from "../index/IndexCategoriesComponent";
    import IndexSearchComponent from "../index/IndexSearchComponent";
    import PopularPostComponent from "../index/PopularPostComponent";
    import TopWeekComponent from "../index/TopWeekComponent";
    import SearchDescPostComponent from "./SearchDescPostComponent";
    import {mapActions, mapGetters, mapMutations} from 'vuex'
    import moment from "moment";
    import VueMarkdown from 'vue-markdown'
    import post from "../../store/modules/posts/post";
    export default {
        components: {
            CommentsComponent,
            VueMarkdown,
            IndexCategoriesComponent,
            IndexSearchComponent,
            PopularPostComponent,
            TopWeekComponent,
            SearchDescPostComponent
        },
        data() {
            return {
                moment: moment,
                routerId: null
            }
        },
        computed: {
            ...mapGetters({
                post: 'getPost',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
                statusLike: 'getStatusLike',
                authStatus: 'getAuthStatus',
                searchData: 'getSearchData',
                searchNotFoundStatus: 'getNotFoundStatus',
            })
        },
        async created() {
            this.routerId = await this.$route.params.id
            await this.showPost(this.routerId)
            this.getLike(this.$route.params.id)
        },
        async beforeRouteLeave(to, from, next) {
            await this.updateNotFoundSearch(false)
            await this.updateSearchData(null)
            await this.updateSearchStatus(false)
            next()
        },
         beforeRouteUpdate(to, from, next) {
            this.showPost(to.params.id)
             this.updateNotFoundSearch(false)
             this.updateSearchData(null)
             this.updateSearchStatus(false)
             next()
        },
        methods: {
            ...mapActions({
                showPost: 'showPost',
                setLike: 'setLike',
                getLike: 'getLike',
            }),
            ...mapMutations({
                updateNotFoundSearch: 'updateNotFoundSearch',
                updateSearchData: 'updateSearchData',
                updateSearchStatus: 'updateSearchStatus',
            }),
            backPost() {
                this.$router.push({ path: '/post/' + this.post.dir});
                this.updateNotFoundSearch(false)
                this.updateSearchData(null)
                this.updateSearchStatus(false)
            }
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
        color: #68d95f;
        border: 1px solid #68d95f;
    }
    .block-test {
        max-height: 80px;
    }
</style>
