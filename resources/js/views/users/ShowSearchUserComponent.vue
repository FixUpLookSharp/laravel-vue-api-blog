<template>
    <tbody>
        <tr v-for="user in users">
            <td>{{ user.name }}</td>
            <td>{{ user.nickname }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.created_at }} дн. </td>
            <td v-if="!user.is_banned">Разрешен</td>
            <td v-else>Запрещен</td>
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
</style>
