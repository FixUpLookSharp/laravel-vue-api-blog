<template>
    <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
            <div v-for="post in posts" class="col-md-6">

                    <div class="blog-entry">
                        <router-link :to="{name: 'post', params:{ id: post.dir}}" class="postIndex">
                        <img :src="getPrefixUrlPhoto + post.photo" alt="Image placeholder">
                        </router-link>
                        <div class="blog-content-body">
                            <div class="post-meta">
                                <span class="author mr-2"><img :src="getPrefixUrlPhoto + auth.photo" alt="Colorlib"> {{ auth.name }}</span>&bullet;
                                <span class="mr-2">{{ moment(post.created_at).format("DD MM YYYY") }}</span> &bullet;
                                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                            </div>
                            <router-link :to="{name: 'post', params:{ id: post.dir}}" class="postIndex">
                            <h2>{{ post.title }}</h2>
                            </router-link>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <nav aria-label="Page navigation" class="text-center">
                    <ul class="pagination">
                        <li v-for="paginate in pagination.links" :class="{active: paginate.active}" class="page-item"><a class="page-link" href="#">{{ paginate.label }}</a></li>
                    </ul>
                    <a @click="test">trxt</a>
                </nav>
            </div>
        </div>
    </div>
</template>



<script>
    import moment from "moment";
    import {mapActions, mapGetters} from 'vuex'
    export default {
        data: function() {
            return {
                moment: moment,
            }
        },
        computed: {
            ...mapGetters({
                posts: 'getPosts',
                pagination: 'getPagination',
                auth: 'getAuth',
                getPrefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
        mounted() {
            this.allPosts()
            this.perPage
        },
        methods: {
            ...mapActions({
                allPosts: 'allPosts'
            }),
            test(){
                console.log(this.pagination)
            }
        },

    }
</script>

<style scoped>
.postIndex {
    text-decoration: none;
    color: black;
}
</style>
