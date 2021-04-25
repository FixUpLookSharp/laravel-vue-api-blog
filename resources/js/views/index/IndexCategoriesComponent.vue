<template>
    <div class="sidebar-box">
        <h3 class="heading">Categories</h3>
        <ul class="categories">
            <li v-for="categories in getCategories" ><a href="#">{{ $t(categories.name) }} <span>({{ categories.articleCount }})</span></a></li>
        </ul>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: {
            ...mapGetters({
                getAuth: 'getAuth',
                getCategories: 'getCategories'

            }),
        },
    }
</script>

<style scoped>

</style>
