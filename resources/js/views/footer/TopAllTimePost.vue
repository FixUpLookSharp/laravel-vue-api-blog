<template>
    <div class="col-md-4">
        <h3>Популярная статья</h3>
        <p class="mb-4">
            <img :src="prefixUrlPhoto + post.photo" alt="Image placeholder" class="img-fluid">
        </p>

        <p>{{ post.title }}
            <router-link @click.native="scrollToTop" :to="{name: 'post', params:{ id: post.dir}}" href="#">Читать пост</router-link></p>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        computed: {
            ...mapGetters({
                post: 'getTopAllTime',
                prefixUrlPhoto: 'getPrefixUrlPhoto'
            })
        },
        mounted() {
            this.topAllTime()
        },
        methods:  {
            ...mapActions({
                topAllTime: 'topAllTime',
                scrollToTop: 'scrollToTop',
            })
        }
    }
</script>

<style scoped>

</style>
