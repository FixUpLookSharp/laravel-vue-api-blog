<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Регистрация</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>
                            <div class="col-md-6">
                                <input id="name" type="text" :class="[getRegisterErrors.name ? 'is-invalid' : '']" class="form-control" v-model="name" required autocomplete="name">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ getRegisterErrors.name }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Адрес</label>
                            <div class="col-md-6">
                                <input id="email" type="email" :class="[getRegisterErrors.email ? 'is-invalid' : '']" class="form-control" v-model="email"  required autocomplete="email">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ getRegisterErrors.email }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>
                            <div class="col-md-6">
                                <input id="password" type="password" :class="[getRegisterErrors.password ? 'is-invalid' : '']" class="form-control" v-model="password" required autocomplete="new-password">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ getRegisterErrors.password }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Подтвердите пароль</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click="registerUser({name: name,email: email,password: password,password_confirmation: password_confirmation, })" type="submit" class="btn btn-primary">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex"
    export default {
        data: function() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        },
        computed: {
            ...mapGetters({
                getAuthStatus: 'getAuthStatus',
                getRegisterErrors: 'getRegisterErrors'
            })
        },
        mounted() {
        },
        methods: {
            ...mapActions({
                registerUser: 'registerUser',
            })
        }
    }
</script>

<style scoped>

</style>
