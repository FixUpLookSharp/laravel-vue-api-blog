<template>
    <div>
        <div v-for="post in posts.data" :key="post.id" class="row mb-5 mt-5">
            <div class="col-md-12">
                <div class="post-entry-horzontal">
                    <router-link @click.native="scrollToTop" class="linkRoute" :to="{name: 'post', params:{ id: post.dir}}">
                        <div class="image " data-animate-effect="fadeIn" :style="{ 'background-image': 'url(' + prefixUrlPhoto + post.photo + ')' }"></div>
                        <span class="text">
                            <div class="post-meta">
                                <span class="author mr-2"><img :src="prefixUrlPhoto + post.creator.photo" class="rounded-circle" alt="user" width="30" height="30"> {{ post.creator.name }}</span>&bullet;
                                <span class="mr-2">{{ moment(post.created_at).format("DD.MM.YYYY") }} </span> &bullet;
                                <span class="mr-2">{{ $t(post.category_name) }}</span> &bullet;
                                <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span>
                                <span class="ml-2"><span class="fa fa-thumbs-up"></span> {{ post.likes_count }}</span>
                            </div>
                            <h2>{{ post.title }}</h2>
                        </span>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";
    import {mapActions, mapGetters} from 'vuex'
    export default {
        data() {
            return {
                moment: moment,
            }
        },
        computed: {
          ...mapGetters({
              prefixUrlPhoto: 'getPrefixUrlPhoto',
          }),
        },
        props: ['posts'],
        methods: {
            ...mapActions({
                scrollToTop: 'scrollToTop',
            }),
        }
    }
</script>

<style scoped>

</style>
