<template>
    <div v-if="view">
        <header-component></header-component>
        <main-component></main-component>
        <footer-component></footer-component>
    </div>
    <div v-else-if="!view">
        <not-found-component></not-found-component>
    </div>
</template>

<script>
    import FooterComponent from "./FooterComponent";
    import HeaderComponent from "./HeaderComponent";
    import MainComponent from "./MainComponent";
    import NotFoundComponent from "../views/NotFoundComponent";
    import {mapGetters, mapActions} from 'vuex'
    export default {
        computed: {
            ...mapGetters({
                view: 'getView'
            })
        },
        components: {
            FooterComponent,
            HeaderComponent,
            MainComponent,
            NotFoundComponent
        },
        mounted() {
            if (this.$route.meta.link == 'notFound') this.notFound(false)
        },
        methods: {
            ...mapActions({
                notFound: 'notFound'
            })
        }
    }
</script>

<style scoped>

</style>
