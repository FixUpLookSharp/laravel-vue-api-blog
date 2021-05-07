<template>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item avatar">
            <a class="nav-link p-0" href="#">
                <img :src="getPrefixUrlPhoto + getAuth.photo" class="rounded-circle z-depth-0"
                     alt="avatar image" height="35">
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-alt"></i> Профиль </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-info">
                <router-link v-if="getAuth.is_admin" class="dropdown-item" to="/">Админ панель</router-link>
                <a class="dropdown-item" href="#">Мой аккаунт</a>
                <a class="dropdown-item" href="#">Мои настройки</a>
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
                getAuth: 'getAuth',
                getPrefixUrlPhoto: 'getPrefixUrlPhoto',
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
