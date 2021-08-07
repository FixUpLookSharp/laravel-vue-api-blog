<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <div class="my-4">
                    <layout-menu-settings-component></layout-menu-settings-component>
                    <div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Старый пароль</label>
                                    <input type="password" v-model="old_password" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="password">Новый пароль</label>
                                    <input type="password" v-model="password" id="password" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>Подтвердите пароль</label>
                                    <input type="password" v-model="password_confirmation" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Требования к паролю</p>
                                <p class="small text-muted mb-2">Чтобы создать новый пароль, вы должны соответствовать всем следующим требованиям:</p>
                                <ul class="small text-muted pl-4 mb-0">
                                    <li>Должен состоять из латинских букв</li>
                                    <li>Минимум 8 символов</li>
                                    <li>По крайней мере, один специальный символ</li>
                                    <li>Хотя бы одно число</li>
                                    <li>Не может быть таким же, как предыдущий пароль</li>
                                </ul>
                            </div>
                        </div>
                        <button @click="changePassword({password: password, old_password: old_password, password_confirmation: password_confirmation
                        })" type="submit" class="btn btn-primary">Сохранить пароль</button>
                    </div>
                    <p @click="test">rttt</p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    import LayoutMenuSettingsComponent from "./LayoutMenuSettingsComponent";
    export default {
        components: {LayoutMenuSettingsComponent},
        data() {
          return {
              password: null,
              old_password: null,
              password_confirmation: null
          }
        },
        computed: {
            ...mapGetters({
                errors: 'getErrorsUser'
            })
        },
        methods: {
            ...mapActions({
                changePassword: 'changePassword'
            }),
            test() {
                console.log(this.errors)
            }
        }
    }
</script>

<style scoped>

</style>
