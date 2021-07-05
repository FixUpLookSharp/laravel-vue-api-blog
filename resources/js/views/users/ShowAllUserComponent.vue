<template>
    <tbody>
        <tr v-for="user in users.data">
            <td>{{ user.name }}</td>
            <td class="sm-4 md992 md575">{{ user.nickname }}</td>
            <td class="sm-4 md992 md575">{{ user.email }}</td>
            <td class="sm-4 md575">{{ user.created_at }} дн. </td>
            <td class="sm-4" v-if="!user.is_banned">Разрешен</td>
            <td class="sm-4" v-else>Запрещен</td>
            <td>
                <div class="badge badge-warning" :class="user.status" >{{ $t(user.status) }}</div>
            </td>
            <td class="text-right">
                <button type="button" class="btn btn-primary btn-sm"><router-link class="routeButton" :to="{name: 'user', params: {id: user.id}}">Подробнее</router-link></button>
            </td>
        </tr>
    </tbody>
</template>

<script>
    export default {
        props: ['users']
    }
</script>

<style scoped>
    .routeButton {
        text-decoration: none;
        color: whitesmoke;
    }
    .user {
        color: whitesmoke;
        background-color: #68d95f;
    }
    .moderator {
        color: whitesmoke;
        background-color: #999918;
    }
    .administrator {
        color: whitesmoke;
        background-color: red;
    }

    @media (min-width: 992px) and  (max-width: 1200px) {
        .md992 {
            display: none;
        }
    }
    @media (min-width: 50px) and  (max-width: 575px) {
        .sm-4 {
            display: none;
        }
    }
    @media (min-width: 576px) and  (max-width: 991px) {
        .md575 {
            display: none;
        }
    }
</style>
