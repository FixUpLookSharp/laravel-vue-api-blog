<template>
    <div class="sidebar-box">
        <h3 class="heading">Категории</h3>
        <ul class="categories">
            <li v-for="categories in getCategories" ><router-link class="router-link" :to="{name: 'category', params:{ id: categories.dir}}">{{ $t(categories.name) }} <span>({{ categories.articleCount }})</span></router-link></li>
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
.router-link {
    text-decoration: none;
    color: black;
}
</style>
