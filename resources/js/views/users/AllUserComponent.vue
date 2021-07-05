<template>
    <div class="row mb-5 mt-5">
        <div class="btn-group-sm btn-group mb-2 col-md-4 col-sm-2">
<!--            <button @click="allUsers(1)" class="btn btn-focus">Все пользователи</button>-->
            <button @click="buttonAllUsers(1)" class="btn btn-focus">Все пользователи</button>
            <button class="btn btn-focus ml-1">Топ по коментарям</button>
            <button class="btn btn-focus ml-1">Топ по постам</button>
        </div>
        <div class="search-form searchInput">
            <div class="mb-2 form-group">
                <span class="icon fa fa-search"></span>
                <input class="form-control search-user" v-model="searchUser" type="search" placeholder="Найти пользователя">
            </div>
        </div>
        <not-found-search-user-component v-if="notFoundStatus"></not-found-search-user-component>
        <table v-else class="table table-users">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Имя</th>
                    <th scope="col" class="sm-4 md992 md575">Ник</th>
                    <th scope="col" class="sm-4 md992 md575">Email</th>
                    <th scope="col" class="sm-4 md575">С нами</th>
                    <th scope="col" class="sm-4">Доступ</th>
                    <th scope="col">Статус</th>
                    <th scope="col" class="text-right">Инфо</th>
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
        components: {
            ShowAllUserComponent,
            ShowSearchUserComponent,
            NotFoundSearchUserComponent
        },
        data() {
            return {
                moment: moment,
                users: {},
                debounceSearch:null,
                searchUser: '',
                url: '/api/V1/user/search',
                test: false,

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
           if (this.$route.query.hasOwnProperty('search') && this.$route.query.search != '') {
               this.fetch({searchData: this.$route.query.search, url: this.url});
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
                    this.$router.push({ path: 'users', query: { search: this.debounceSearch } });
                }
                if (!this.debounceSearch) {
                    if (this.$route.query.hasOwnProperty('search')) {
                        this.$router.push({ path: 'users' });
                    }
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
            buttonAllUsers(page) {
                if (this.$route.query.hasOwnProperty('search')) {
                    this.$router.push({ path: 'users' });
                }
                this.allUsers()
            },
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
                // if (this.$route.query.hasOwnProperty('search') && this.searchUser == 'test') {
                //     this.$router.push({ path: 'users' });
                // }
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
        margin-left: 400px;
    }

    .search-user {
        width: 350px;
    }

    .table-users {
        font-size: 14px;
    }

    @media (min-width: 992px) and  (max-width: 1200px) {
        .searchInput {
            margin-left: 280px;
        }

        .md992 {
            display: none;
        }
    }
    @media (min-width: 50px) and  (max-width: 575px) {
        .searchInput {
            margin-left: 15px;
        }

        .sm-4 {
            display: none;
        }
    }

    @media (min-width: 576px) and  (max-width: 767px) {
        .searchInput {
            margin-left: 320px;
        }
        .md575 {
            display: none;
        }
        .search-user {
            width: 130px;
        }
    }
    @media (min-width: 768px) and  (max-width: 991px) {
        .searchInput {
            margin-left: 220px;
        }
        .md575 {
            display: none;
        }

        .search-user {
            width: 250px;
        }

    }



</style>
