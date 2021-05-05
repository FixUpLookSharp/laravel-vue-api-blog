<template>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Написать пост</h1>
                    <div>
                        <div class="form-group has-error">
                            <label>Заголовок</label>
                            <input type="text" class="form-control" v-model="title" />
                        </div>
                        <div class="form-group">
                            <label>Выберите категорию</label>
                            <select v-model="category_id" class="form-control">
                                <option v-for="categories in getCategories" :value="categories.id" >{{ $t(categories.name) }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Краткое описание</label>
                            <textarea rows="3" class="form-control" v-model="short_description" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <vue-simplemde v-model="description" ref="markdownEditor" />
                        </div>
                        <div class="form-group">
                            <b-form-file
                                v-model="photo"
                                :state="Boolean(photo)"
                                placeholder="Выберите файл или перетащите сюда ..."
                                drop-placeholder="Перетащите файл сюда ..."
                            ></b-form-file>
                        </div>
                        <div class="form-group">
                            <button @click="sendPost({
                            title: title,
                            category_id: category_id,
                            description: description,
                            short_description: short_description,
                            photo: photo
                            })" type="submit" class="btn btn-success">
                                Создать пост
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
    import {mapActions, mapGetters} from "vuex"
    import VueSimplemde from 'vue-simplemde'

    export default {
        components: {VueSimplemde},
        data: function () {
            return {
                title: '',
                category_id: null,
                description: '',
                short_description: '',
                photo: null,
            }
        },
        computed: {
            ...mapGetters({
                getCategories: 'getCategories',
                getAuth: 'getAuth',
            })
        },
        methods: {
            ...mapActions({
                sendPost: 'sendPost'
            }),
        }

    }
</script>

<style scoped>
    @import '~simplemde/dist/simplemde.min.css';
</style>
