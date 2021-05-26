<template>
    <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
            <div v-for="post in posts.data" :key="post.id" class="col-md-6">
                    <div class="blog-entry">
                        <router-link :to="{name: 'post', params:{ id: post.dir}}" class="postIndex">
                        <img :src="getPrefixUrlPhoto + post.photo" alt="Image placeholder">
                        </router-link>
                        <div class="blog-content-body">
                            <div class="post-meta">
                                <span class="author mr-2"><img :src="getPrefixUrlPhoto + post.creator.photo" alt="Colorlib"> {{ post.creator.name }}</span>&bullet;
                                <span class="mr-2">{{ moment(post.created_at).format("DD.MM.YYYY") }}</span> &bullet;
                                <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span>
                                <span class="ml-2"><span class="fa fa-thumbs-up"></span> {{ post.likes_count }}</span>

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
                <paginate-component :data="posts" :limit="1" :show-disabled="true" :align="'center'" @pagination-change-page="allPosts"></paginate-component>
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
                posts: {},
            }
        },
        computed: {
            ...mapGetters({
                auth: 'getAuth',
                getPrefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
        created() {
            this.allPosts()
        },
        methods: {
           async allPosts(page = 1) {
               await axios({
                    method: 'get',
                    url: '/api/V1/article?page=' + page
                }).then((response) => {
                        this.posts = response.data
                })
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
