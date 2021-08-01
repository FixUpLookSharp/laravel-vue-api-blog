<template>
    <div class="sidebar-box search-form-wrap">
        <div  class="search-form">
            <div class="form-group">
                <span class="icon fa fa-search"></span>
                <input type="text" class="form-control" v-model="searchArticle" :placeholder="placeholder">
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapMutations}  from 'vuex'
    import {debounce} from "../../helper";
    import categories from "../../store/modules/header/categories";
    export default {
        data() {
            return {
                debounceSearch: null,
                searchArticle: '',
            }
        },
       async mounted() {
           await this.updateUrlPlaceholder()
        },
        computed: {
          ...mapGetters({
              placeholder: 'getSearchPlaceholder',
              url: 'getSearchUrl',
              searchStatus: 'getSearchStatus',
              searchPath: 'getSearchPath',
          }),
        },
        watch: {
            searchArticle: debounce(function (newVal) {
                this.debounceSearch = newVal;
            }, 400),
            debounceSearch(after, before) {
                if (this.debounceSearch) {
                    this.fetch({searchData: this.debounceSearch, url: this.url});
                    if (this.$route.query.search == this.debounceSearch) {
                        return;
                    }
                    this.$router.push({ path: this.searchPath, query: { search: this.debounceSearch } });
                }
                if (!this.debounceSearch) {
                    this.updateFetch()
                    if (this.$route.query.hasOwnProperty('search')) {
                        this.$router.push({ path: this.searchPath });
                    }
                }
            },
        },
        methods: {
            ...mapActions({
                fetch: 'fetch',
                updateFetch: 'updateFetch',
                getUrl: 'getUrl'
            }),
            async updateUrlPlaceholder() {
                if (this.$route.name == 'index') {
                   await this.getUrl({
                       url: '/api/V1/article/search/index',
                       placeholder: 'Найти статью',
                       path: ''
                    })
                    this.searchMounted()
                } else if (this.$route.name == 'category') {
                    await this.getUrl({
                        url: '/api/V1/article/search/category/' + this.$route.params.id,
                        placeholder: 'Найти статью в категории ' + this.$t('categories' + '.' + this.$route.params.id),
                        path: '/category/' + this.$route.params.id,
                    })
                    this.searchMounted()
                } else if (this.$route.name == 'post') {
                    await this.getUrl({
                        url: '/api/V1/article/search/post',
                        placeholder: 'Найти пост',
                        path: '/post/' + this.$route.params.id,
                    })
                    this.searchMounted()
                }
            },
             searchMounted() {
                if (this.$route.query.hasOwnProperty('search') && this.$route.query.search != '') {
                    this.fetch({searchData: this.$route.query.search, url: this.url});
                }
            },
        },

    }

</script>

<style scoped>

</style>
