<template>
    <section class="site-section pt-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h2 class="mb-4">Категория: </h2>
                </div>
            </div>
            <div class="row blog-entries">
                <div class="col-md-12 col-lg-8 main-content">
                    <div v-for="post in posts.data" :key="post.id" class="row mb-5 mt-5">
                        <div class="col-md-12">
                            <div class="post-entry-horzontal">
                                <router-link :to="{name: 'post', params:{ id: post.dir}}">
                                    <div class="image " data-animate-effect="fadeIn" :style="{ 'background-image': 'url(' + prefixUrlPhoto + post.photo + ')' }"></div>
                                    <span class="text">
                                        <div class="post-meta">
                                            <span class="author mr-2"><img :src="prefixUrlPhoto + post.creator.photo" alt="Colorlib"> Colorlib</span>&bullet;
                                            <span class="mr-2">{{ moment(post.created_at).format("DD.MM.YYYY") }} </span> &bullet;
                                            <span class="mr-2">{{ $t(post.category_name) }}</span> &bullet;
                                            <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span>
                                            <span class="ml-2"><span class="fa fa-thumbs-up"></span> {{ post.likes_count }}</span>
                                        </div>
                                        <h2>There’s a Cool New Way for Men to Wear Socks and Sandals</h2>
                                    </span>
                                </router-link>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <paginate-component :data="posts" :limit="1" :show-disabled="true" :align="'center'" @pagination-change-page="allPostsCategory({})"></paginate-component>
                    </div>
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
    import IndexCategoriesComponent from "../index/IndexCategoriesComponent";
    import IndexSearchComponent from "../index/IndexSearchComponent";
    import PopularPostComponent from "../index/PopularPostComponent";
    import TopWeekComponent from "../index/TopWeekComponent";
    import {mapActions, mapGetters} from 'vuex'
    import moment from "moment";
    import router from "../../router";
    export default {
        components: {
            IndexCategoriesComponent,
            IndexSearchComponent,
            PopularPostComponent,
            TopWeekComponent
        },
        data() {
            return {
                moment: moment,
                posts: {},
                cat: ''
            }
        },
        computed: {
            ...mapGetters({
                prefixUrlPhoto: 'getPrefixUrlPhoto',
            }),
        },
       mounted() {
            this.cat = this.$route.params.id
           this.allPostsCategory(this.cat)
       },
        beforeRouteUpdate(to, from, next) {
            console.log(to)
            next()
        },
        methods: {
           async allPostsCategory(pas) {
               // pas['page'] = 1
               console.log(pas)
               await axios({
                    method: 'get',
                    url: '/api/V1/category/' + 'games' + '?page=' + 1
                }).then((response) => {
                    this.posts = response.data
                }).catch(error => {
                    router.push('/')
                })
            },
        }
    }
</script>

<style scoped>

</style>
