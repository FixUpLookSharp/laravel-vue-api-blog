<template>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'login' }">Логин</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'register' }">Регистрация</router-link>
        </li>
    </ul>
</template>

<script>
    export default {

    }
</script>

<style scoped>

</style>
