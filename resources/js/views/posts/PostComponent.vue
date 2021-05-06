<template>
    <div>
        <h1>
            Получилось
            сделать шаблон и вывод единой статьи так по ссылке сделать перенаправление с главной стр
        </h1>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'
    export default {
        methods: {
            ...mapActions({
                showPost: 'showPost',
            })
        },
        mounted() {
          this.showPost(this.$route.params.id)
        }
    }
</script>

<style scoped>

</style>
