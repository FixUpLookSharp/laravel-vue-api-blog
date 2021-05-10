<template>
    <div class="row main-blog-create">
        <div class="col-md-10 col-lg-10 col-md-offset-2 create-post-blog">
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
</template>
<script>
    import {mapActions, mapGetters, mapMutations} from "vuex"
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
            ...mapMutations({
                updateErrorTitle: 'updateErrorTitle',
                updateErrorPhoto: 'updateErrorPhoto',
                updateErrorCategoryId: 'updateErrorCategoryId',
                updateErrorDescription: 'updateErrorDescription'
            })
        },

        watch: {
            title: function (e) {
                this.updateErrorTitle(null)
            },
            category_id: function (e) {
                this.updateErrorCategoryId(null)
            },
            description: function (e) {
                this.updateErrorDescription(null)
            },
            photo: function (e) {
                this.updateErrorPhoto(null)
            }
        }
    }
</script>

<style scoped>
    @import '~simplemde/dist/simplemde.min.css';
    .main-blog-create {
        margin-top: 15px;
        margin-bottom: 20px;
    }

    @media (min-width: 800px) {
        .create-post-blog {
            padding-left: 120px;
        }
    }

    @media (min-width: 790px) and (max-width: 990px){
        .create-post-blog {
            width: 600px;
        }
    }
</style>
