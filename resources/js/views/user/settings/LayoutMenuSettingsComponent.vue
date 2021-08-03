<template>
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <router-link :to="{name: 'userSettings'}" class="nav-link linkRoute" :class="[links.linkSettings ? 'active' : '']">Профиль</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'userChangePassword'}" class="nav-link linkRoute" :class="[links.linkPassword ? 'active' : '']">Настройки пароля</router-link>
        </li>
    </ul>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        created() {
            this.linkActive(this.$route.meta.link)
        },
        computed: {
            ...mapGetters({
                links: 'getLinksSettings'
            })
        },
        methods: {
            ...mapActions({
                linkActive: 'linkActive'
            })
        }
    }
</script>

<style scoped>

</style>
