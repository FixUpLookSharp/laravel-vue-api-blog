<template>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Количество постов</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <span>{{ user.count_articles }} шт</span>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Написанные коментарии</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <span>{{ user.count_comments }} шт</span>
                    </div>
                </div>
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
