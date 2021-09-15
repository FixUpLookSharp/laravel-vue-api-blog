<template>
    <div>
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color nav-info-color">
            <router-link class="navbar-brand" to="/"> Блог обо всем</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <auth-component v-if="authStatus"></auth-component>
                <guest-component v-else></guest-component>
            </div>
        </nav>
        <header role="banner">
            <div class="container logo-wrap">
                <div class="row pt-5">
                    <div class="col-12 text-center">
                        <a style="padding-top: 15px" class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
                    <div id="class"></div>
                        <h1 class="site-logo"><router-link style="text-decoration: none;" to="/">Блог обо Всем!</router-link></h1>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-md  navbar-light bg-light">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav mx-auto">
                            <li @click="mainActiveLink('main')" class="nav-item">
                                <router-link class="nav-link" :class="[mainLink == 'main' ? 'active' : '']" to="/">Главная</router-link>
                            </li>
                            <li @click="mainActiveLink('biz')" class="nav-item">
                                <router-link class="nav-link" :class="[mainLink == 'biz' ? 'active' : '']" to="/users">Пользователи</router-link>
                            </li>
                            <li @click="mainActiveLink('cat')" class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" :class="[mainLink == 'cat' ? 'active' : '']" href="category.html" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Категории</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown05">
                                    <router-link v-for="category in categories" :key="category.id"  class="dropdown-item"  :to="{name: 'category', params:{ id: category.dir}}">{{ $t(category.name) }}</router-link>
                                </div>
                            </li>
                            <li @click="mainActiveLink('usl')" class="nav-item">
                                <router-link class="nav-link" :to="{name: 'games'}" :class="[mainLink == 'usl' ? 'active' : '']">Игры</router-link>
                            </li>
                            <li @click="mainActiveLink('con')" class="nav-item">
                                <a class="nav-link" :class="[mainLink == 'con' ? 'active' : '']" href="#">Контакты</a>
                            </li>
                            <li @click="mainActiveLink('post')" class="nav-item">
                                <router-link class="nav-link" :class="[mainLink == 'post' ? 'active' : '']" :to="{name: 'createPost'}">Написать пост</router-link>
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
        components: {AuthComponent, GuestComponent},
        computed: {
            ...mapGetters({
                authStatus: 'getAuthStatus',
                categories: 'getCategories',
                mainLink: 'getMainLink'

            })
        },
        created() {
            this.mainActiveLink(localStorage.getItem('link'))
            this.categoryAll()
        },
        methods: {
            ...mapActions({
                categoryAll: 'categoryAll',
                mainActiveLink: 'mainActiveLink'
            }),
        }
    }
</script>





