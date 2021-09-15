<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <div class="my-4">
                    <layout-menu-settings-component></layout-menu-settings-component>
                        <div class="col-md-12 col-lg-12 main-content">
                            <div v-for="post in posts" :key="post.id" class="row mb-1 mt-1">
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
                            <p v-if="!posts">У вас постов еще не создано</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";
    import LayoutMenuSettingsComponent from "../settings/LayoutMenuSettingsComponent";
    import {mapActions, mapGetters} from 'vuex'
    export default {
        components: {LayoutMenuSettingsComponent},
        data() {
            return {
                moment: moment,
            }
        },
        computed: {
            ...mapGetters({
                prefixUrlPhoto: 'getPrefixUrlPhoto',
                posts: 'getUserPosts',
            }),
        },
       async created() {
            await this.userPosts()
        },
        methods: {
            ...mapActions({
                scrollToTop: 'scrollToTop',
                userPosts: 'userPosts'
            }),
        }
    }
</script>

<style scoped>

</style>
