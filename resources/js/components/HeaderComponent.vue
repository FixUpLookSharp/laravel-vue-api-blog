<template>
    <div>
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color nav-info-color">
            <router-link class="navbar-brand" to="/"> Блог обо всем</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <auth-component v-if="getAuthStatus"></auth-component>
                <guest-component v-else></guest-component>
            </div>
        </nav>
        <header role="banner">
            <div class="container logo-wrap">
                <div class="row pt-5">
                    <div class="col-12 text-center">
                        <a style="padding-top: 15px" class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>

                        <h1 class="site-logo"><router-link style="text-decoration: none;" to="/">Блог обо Всем!</router-link></h1>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-md  navbar-light bg-light">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <router-link class="nav-link active" to="/">Главная</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Business</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="category.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Travel</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="category.html">Asia</a>
                                    <a class="dropdown-item" href="category.html">Europe</a>
                                    <a class="dropdown-item" href="category.html">Dubai</a>
                                    <a class="dropdown-item" href="category.html">Africa</a>
                                    <a class="dropdown-item" href="category.html">South America</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="category.html" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown05">
                                    <a v-for="categories in getCategories" class="dropdown-item" href="#">{{ $t(categories.name) }}</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.html">Contact</a>
                            </li>
                            <li v-if="getAuthStatus" class="nav-item">
                                <router-link class="nav-link" :to="{name: 'createPost'}">Написать пост</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>
</template>


<script>
    import AuthComponent from "../views/auth/AuthComponent";
    import GuestComponent from "../views/auth/GuestComponent";
    import { mapGetters, mapActions } from "vuex"
    export default {
        components: {AuthComponent, GuestComponent,},
        data: function () {
          return {
              test: ''
          }
        },
        computed: {
            ...mapGetters({
                getAuthStatus: 'getAuthStatus',
                getCategories: 'getCategories',
            })
        },
        mounted() {
            this.categoryAll()
        },
        methods: {
            ...mapActions({
                categoryAll: 'categoryAll'
            }),
        }
    }
</script>
