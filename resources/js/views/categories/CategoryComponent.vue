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
                    <categories-component v-if="!searchData" :posts="posts"></categories-component>
                    <categories-search-component v-else-if="searchData" :posts="searchData"></categories-search-component>
                    <div class="col-md-12 text-center">
                        <paginate-component v-if="!searchData" :data="posts" :limit="1" :show-disabled="true" :align="'center'" @pagination-change-page="changePage"></paginate-component>
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
    import CategoriesSearchComponent from "./category/CategoriesSearchComponent";
    import CategoriesComponent from "./category/CategoriesComponent";
    import {mapActions, mapGetters, mapMutations} from 'vuex'
    import router from "../../router";
    export default {
        components: {
            IndexCategoriesComponent,
            IndexSearchComponent,
            PopularPostComponent,
            TopWeekComponent,
            CategoriesSearchComponent,
            CategoriesComponent
        },
        data() {
            return {
                posts: {},
                cat: ''
            }
        },
        computed: {
            ...mapGetters({
                prefixUrlPhoto: 'getPrefixUrlPhoto',
                searchData: 'getSearchData',
                notFoundStatus: 'getNotFoundStatus',
            }),
        },
       mounted() {
           this.cat = this.$route.params.id
           let page = 1
           if (this.$route.query.hasOwnProperty('page')) {
               page = this.$route.query.page
           }
           this.allPostsCategory(page)
       },
        async beforeRouteLeave(to, from, next) {
            await this.updateNotFoundSearch(false)
            await this.updateSearchData(null)
            await this.updateSearchStatus(false)
            next()
        },
         beforeRouteUpdate(to, from, next) {
            this.cat = to.params.id
            let page = 1
            if (to.query.hasOwnProperty('page')) {
                page = to.query.page
            }
            this.getUrl({
                url: '/api/V1/article/search/category/' + to.params.id,
                placeholder: 'Найти статью в категории ' + this.$t('categories' + '.' + to.params.id),
            })
             this.allPostsCategory(page)
            next()
        },
        methods: {
            ...mapActions({
                getUrl: 'getUrl'
            }),
            ...mapMutations({
                updateNotFoundSearch: 'updateNotFoundSearch',
                updateSearchData: 'updateSearchData',
                updateSearchStatus: 'updateSearchStatus',

            }),
           async changePage(page = 1) {
               if (this.$route.query.page == page) {
                   return;
               }
               this.$router.push({ path: "/category/" + this.cat, query: { page: page } });
               if (page == 1) {
                   this.$router.push({ path: '/category/' + this.cat  });
               }
           },
            async allPostsCategory(page) {
                await axios({
                    method: 'get',
                    url: '/api/V1/category/' + this.cat + '?page=' + page
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
