<template>
    <div class="row mb-5 mt-5">
        <div class="btn-group-sm btn-group mb-2">
            <button @click="allUsers(1)" class="btn btn-focus">Все пользователи</button>
            <button class="btn btn-focus ml-1">Топ по количеству коментариев</button>
            <button class="btn btn-focus ml-1">Топ по постам</button>
        </div>
        <div class="search-form searchInput">
            <div class="mb-2 form-group">
                <span class="icon fa fa-search"></span>
                <input class="form-control search-user" v-model="searchUser" type="search" placeholder="Найти пользователя">
            </div>
        </div>
        <not-found-search-user-component v-if="notFoundStatus"></not-found-search-user-component>
        <table v-else class="table col-md-12">
            <thead class="thead-dark">
                <tr>
                    <th>Имя</th>
                    <th>Ник</th>
                    <th>Email</th>
                    <th>С нами</th>
                    <th>Доступ</th>
                    <th>Статус</th>
                    <th class="text-right">Информация</th>
                </tr>
            </thead>
            <show-all-user-component v-if="!searchData" :users="users"></show-all-user-component>
            <show-search-user-component v-else-if="searchData" :users="searchData"></show-search-user-component>
        </table>
            <div class="col-md-12 text-center">
                <paginate-component v-if="!searchData" :data="users" :limit="1" :show-disabled="true" :align="'center'" @pagination-change-page="changePage"></paginate-component>
            </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapMutations}  from 'vuex'
    import { debounce } from "../../helper";
    import moment from "moment";
    import ShowAllUserComponent from "./ShowAllUserComponent";
    import ShowSearchUserComponent from "./ShowSearchUserComponent";
    import NotFoundSearchUserComponent from "./NotFoundSearchUserComponent";
    export default {
        components: {ShowAllUserComponent, ShowSearchUserComponent, NotFoundSearchUserComponent},
        data() {
            return {
                moment: moment,
                users: {},
                debounceSearch:null,
                searchUser: '',
                url: '/api/V1/user/search'

            }
        },
        computed: {
            ...mapGetters({
                prefixUrlPhoto: 'getPrefixUrlPhoto',
                searchData: 'getSearchData',
                notFoundStatus: 'getNotFoundStatus',
            })
        },
       async mounted() {
            let page = 1
            if (this.$route.query.hasOwnProperty('page')) {
                page = this.$route.query.page
            }
          await this.allUsers(page)
        },
        watch: {
            searchUser: debounce(function (newVal) {
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
                updateFetch: 'updateFetch'
            }),
            ...mapMutations({
                updateNotFoundSearch: 'updateNotFoundSearch',
                updateSearchData: 'updateSearchData'

            }),
            async changePage(page) {
                if (this.$route.query.page == page) {
                    return;
                }
                this.$router.push({ path: '', query: { page: page } });
                if (page == 1) {
                    this.$router.push({ path: ''  });
                }
                this.allUsers(page)
            },
            async allUsers(page = 1) {
                this.updateNotFoundSearch(false)
                this.updateSearchData(false)
                this.searchUser = ''

                if (this.$route.query.hasOwnProperty('page')) {
                    page = this.$route.query.page
                }
                
                await axios({
                    method: 'get',
                    url: '/api/V1/users?page=' + page
                }).then((response) => {
                    this.users = response.data
                })
            }
        }
    }
</script>

<style scoped>
    .btn-focus {
        border-radius: 5px;
        background-color: #343a40;
        padding-left: 5px;
        color: whitesmoke;
    }
    .searchInput {
        margin-left: 300px;
    }

    .search-user {
        width: 350px;
    }
</style>
