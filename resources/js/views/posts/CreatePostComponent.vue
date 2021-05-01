<template>
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-md-8 col-md-offset-2">-->
<!--                    <h1>Написать пост</h1>-->
<!--                    <div>-->
<!--                        <div class="form-group has-error">-->
<!--                            <label>Заголовок</label>-->
<!--                            <input type="text" class="form-control" name="title" />-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="exampleFormControlSelect1">Example select</label>-->
<!--                            <select class="form-control" id="exampleFormControlSelect1">-->
<!--                                <option>1</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="description">Description</label>-->
<!--                            <markdown-editor v-model="body"></markdown-editor>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <p><span class="require">*</span> - required fields</p>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <button type="submit" class="btn btn-primary">-->
<!--                                Create-->
<!--                            </button>-->
<!--                            <button class="btn btn-success">-->
<!--                                Cancel-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    <div class="container">

    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex"
    export default {
        data: function () {
            return {
                title: '',
                creator_id: null,
                category_id: null,
                description: '',
                short_description: '',
                body: '',
                photo: '',
            }
        }

    }
</script>

<style scoped>

</style>
