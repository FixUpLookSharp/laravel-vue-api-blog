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
              getSearchStatus: 'getSearchStatus'
          }),
        },
        watch: {
            searchArticle: debounce(function (newVal) {
                this.debounceSearch = newVal;
            }, 400),
            debounceSearch(after, before) {
                if (this.debounceSearch) {
                    this.fetch({searchData: this.debounceSearch, url: this.url});
                }
                if (!this.debounceSearch) {
                    this.updateFetch()
                }
            },
        },
        methods: {
            ...mapActions({
                fetch: 'fetch',
                updateFetch: 'updateFetch',
                getUrl: 'getUrl'
            }),
            ...mapMutations({
                updateSearchCategory: 'updateSearchCategory',
            }),
            updateUrlPlaceholder() {
                if (this.$route.name == 'index') {
                    this.getUrl({
                        url: '/api/V1/article/search/index',
                        placeholder: 'Найти статью',
                    })
                } else if (this.$route.name == 'category') {
                    this.getUrl({
                        url: '/api/V1/article/search/category/' + this.$route.params.id,
                        placeholder: 'Найти статью в категории ' + this.$t('categories' + '.' + this.$route.params.id),
                    })
                } else if (this.$route.name == 'post') {
                    this.getUrl({
                        url: '/api/V1/article/search/post',
                        placeholder: 'Найти пост',
                    })
                }
            },
        },

    }

</script>

<style scoped>

</style>
