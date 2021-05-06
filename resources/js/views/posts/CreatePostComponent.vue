<template>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Написать пост</h1>
                    <div>
                        <div class="form-group has-error">
                            <label>Наименование</label>
                            <input  :class="[getErrorTitle ? 'is-invalid' : '']" type="text" class="form-control" v-model="title"/>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ getErrorTitle }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Выберите категорию</label>
                            <select :class="[getErrorCategoryId ? 'is-invalid' : '']" v-model="category_id" class="form-control">
                                <option v-for="categories in getCategories" :value="categories.id" >{{ $t(categories.name) }}</option>
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$t(getErrorCategoryId)}}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Краткое описание</label>
                            <textarea :class="[getErrorShortDescription ? 'is-invalid' : '']" rows="3" class="form-control" v-model="short_description" ></textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$t(getErrorShortDescription)}}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <vue-simplemde :class="[getErrorDescription ? 'is-invalid' : '']" v-model="description" ref="markdownEditor" />
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ getErrorDescription }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Изображение поста</label>
                            <b-form-file
                                :class="[getErrorPhoto ? 'is-invalid' : '']"
                                v-model="photo"
                                :state="Boolean(photo)"
                                placeholder="Выберите файл или перетащите сюда ..."
                                drop-placeholder="Перетащите файл сюда ..."
                            ></b-form-file>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$t(getErrorPhoto)}}</strong>
                            </span>
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
    import {mapActions, mapGetters, } from "vuex"
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
                getErrorShortDescription: 'getErrorShortDescription',
                getErrorCategoryId: 'getErrorCategoryId',
                getErrorPhoto: 'getErrorPhoto',
                getErrorTitle: 'getErrorTitle',
                getErrorDescription: "getErrorDescription"
            }),
        },
        methods: {
            ...mapActions({
                sendPost: 'sendPost'
            }),
        },

    }
</script>

<style scoped>
    @import '~simplemde/dist/simplemde.min.css';
</style>
