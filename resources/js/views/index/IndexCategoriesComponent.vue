<template>
    <div class="sidebar-box">
        <h3 class="heading">Категории</h3>
        <ul class="categories">
            <li v-for="categories in getCategories" ><router-link @click.native="scrollToTop" class="router-link" :to="{name: 'category', params:{ id: categories.dir}}">{{ $t(categories.name) }} <span>({{ categories.articleCount }})</span></router-link></li>
        </ul>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        computed: {
            ...mapGetters({
                getAuth: 'getAuth',
                getCategories: 'getCategories'
            }),
        },
        methods: {
            ...mapActions({
                scrollToTop: 'scrollToTop',
            }),
        }

    }
</script>

<style scoped>
.router-link {
    text-decoration: none;
    color: black;
}
</style>
