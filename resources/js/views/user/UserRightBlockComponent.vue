<template>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">Имя</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <span>{{ user.name }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <span>{{ user.email }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">Телефон</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <span v-if="user.phone">{{ user.phone }}</span>
                <span v-else>отсутствует</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">Адрес</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <span v-if="user.address">{{ user.address }}</span>
                <span v-else>отсутствует</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">Обо мне</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <p v-if="user.info">{{ user.info }}</p>
                <span v-else>отсутствует</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user']
    }
</script>

<style scoped>

</style>
