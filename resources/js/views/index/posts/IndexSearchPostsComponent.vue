<template>
    <div v-if="posts" class="row">
        <div  v-for="post in posts" :key="post.id" class="col-md-6">
            <div class="blog-entry">
                <router-link :to="{name: 'post', params:{ id: post.dir}}" class="postIndex">
                    <img :src="prefixUrlPhoto + post.photo" alt="Image placeholder">
                </router-link>
                <div class="blog-content-body">
                    <div class="post-meta">
                        <span class="author mr-2"><img :src="prefixUrlPhoto + post.creator.photo" alt="Colorlib"> {{ post.creator.name }}</span>&bullet;
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
</template>

<script>
    import {mapGetters} from 'vuex'
    import moment from "moment";
    export default {
        data: function() {
            return {
                moment: moment,
            }
        },
        props: ['posts'],
        computed: {
            ...mapGetters({
                auth: 'getAuth',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
    }
</script>

<style scoped>

</style>
