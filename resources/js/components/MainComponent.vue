<template>
    <main class="container">
        <router-view v-if="!auth || !auth.is_banned"></router-view>
        <blocked-user-component v-else-if="auth.is_banned && auth">Вы заблокированы</blocked-user-component>
    </main>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    import BlockedUserComponent from "../views/user/BlockedUserComponent";
    export default {
        components: {
          BlockedUserComponent
        },
        computed: {
          ...mapGetters({
              auth: 'getAuth'
          })
        },
    }
</script>

<style scoped>

</style>
