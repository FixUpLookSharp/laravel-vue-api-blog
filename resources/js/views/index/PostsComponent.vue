<template>
    <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
            <index-posts-component v-if="!searchData" :posts="posts"></index-posts-component>
            <index-search-posts-component v-else-if="searchData" :posts="searchData"></index-search-posts-component>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <paginate-component v-if="!searchData" :data="posts" :limit="1" :show-disabled="true" :align="'center'" @pagination-change-page="changePage"></paginate-component>
            </div>
        </div>
    </div>
</template>



<script>
    import {mapGetters, mapMutations} from 'vuex'
    import IndexPostsComponent from "./posts/IndexPostsComponent";
    import IndexSearchPostsComponent from "./posts/IndexSearchPostsComponent";
    export default {
        components: {
            IndexPostsComponent,
            IndexSearchPostsComponent,
        },
        data: function() {
            return {
                posts: {},
            }
        },
        computed: {
          ...mapGetters({
              searchData: 'getSearchData',
              notFoundStatus: 'getNotFoundStatus',
          })
        },
        mounted() {
            let page = 1
            if (this.$route.query.hasOwnProperty('page')) {
                page = this.$route.query.page
            }
            this.allPosts(page)

        },
        methods: {
            async changePage(page) {
                if (this.$route.query.page == page) {
                    return;
                }
                this.$router.push({ path: '', query: { page: page } });
                if (page == 1) {
                    this.$router.push({ path: ''  });
                }
                this.allPosts(page)
            },
           async allPosts(page = 1) {

               await axios({
                    method: 'get',
                    url: '/api/V1/article?page=' + page
                }).then((response) => {
                   this.posts = response.data
                })
            },
        },

    }
</script>

<style scoped>
.postIndex {
    text-decoration: none;
    color: black;
}
</style>
