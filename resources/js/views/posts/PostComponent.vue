<template>
    <div v-if="post">
        <h1>
            {{ post.title }}
        </h1>
        <h3>{{ post.short_description }}</h3>
        <p>{{ post.description }}</p>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        computed: {
            ...mapGetters({
                post: 'getPost',
            })
        },
        created() {
            this.showPost(this.$route.params.id)
        },

        mounted() {

        },
        methods: {
            ...mapActions({
                showPost: 'showPost',
            })
        },
    }
</script>

<style scoped>

</style>
