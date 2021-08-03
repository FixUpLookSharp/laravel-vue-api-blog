<template>
    <div>
        <footer class="site-footer">
            <div class="container">
                <div class="row mb-5">
                    <top-all-time-post></top-all-time-post>
                    <div class="col-md-6 ml-auto">
                        <div class="row">
                            <div class="col-md-7">
                                <h3>Latest Post</h3>
                                <div class="post-entry-sidebar">
                                    <recent-posts></recent-posts>
                                </div>
                            </div>
                            <div class="col-md-1"></div>

                            <div class="col-md-4">
                                <div class="mb-5">
                                    <h3>Быстрые ссылки</h3>
                                    <ul class="list-unstyled">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Travel</a></li>
                                        <li><a href="#">Adventure</a></li>
                                        <li><a href="#">Courses</a></li>
                                        <li><a href="#">Categories</a></li>
                                    </ul>
                                </div>
                                <div class="mb-5">
                                    <h3>Соц. сети</h3>
                                    <ul class="list-unstyled footer-social">
                                        <li><a href="#"><span class="fa fa-facebook"></span> Facebook</a></li>
                                        <li><a href="#"><span class="fa fa-instagram"></span> Instagram</a></li>
                                        <li><a href="#"><span class="fa fa-youtube-play"></span> Youtube</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="small">
                            Практика блога на VUE + LARAVEL
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import RecentPosts from "../views/footer/RecentPosts";
    import TopAllTimePost from "../views/footer/TopAllTimePost";
    export default {
        components: {
            RecentPosts,
            TopAllTimePost,
        },
        computed: {
            ...mapGetters({
                getAuth: 'getAuth',
                getCategories: 'getCategories'
            }),
        },
        mounted() {

        },
        methods: {}
    }
</script>
