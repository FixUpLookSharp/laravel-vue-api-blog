<template>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item avatar">
            <a class="nav-link p-0" href="#">
                <img :src="prefixUrlPhoto + auth.photo" class="rounded-circle z-depth-0"
                     alt="avatar image" height="35" width="35">
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-alt"></i> {{ auth.name }}</a>
            <div class="dropdown-menu dropdown-menu-right dropdown-info">
                <router-link v-if="auth.role_id == 3" class="dropdown-item" to="/">Админ панель</router-link>
                <router-link :to="{name: 'user', params: {id: auth.id}}" class="dropdown-item">Мой профиль</router-link>
                <router-link :to="{name: 'userSettings'}" class="dropdown-item">Мои настройки</router-link>
                <router-link :to="{name: 'chat-all'}" class="dropdown-item" >Чат</router-link>
                <a @click="logout" class="dropdown-item cursor-logout">Выйти</a>
            </div>
        </li>
    </ul>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    export default {
        computed: {
            ...mapGetters({
                auth: 'getAuth',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
        mounted() {

        },
        methods: {
            ...mapActions({
                logout: 'logout',
            })
        },
    }
</script>

<style scoped>

</style>
