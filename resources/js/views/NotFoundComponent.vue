<template>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>Ой!</h1>
            </div>
            <h2>404 СТРАНИЦА НЕ НАЙДЕНА</h2>
            <p>Страница, которую вы ищете, могла быть удалена из-за изменения ее названия или временно недоступна.</p>
        </div>
    </div>
</template>

<script>
    import {mapActions} from "vuex";
    export default {
        methods: {
            ...mapActions({
                notFound: 'notFound'
            })
        }
    }
</script>

<style scoped>

</style>
