<template>
    <div class="container">
        <div class="row justify-content-center">
<!--            <div class="col-md-8">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">Регистрация</div>-->
<!--                    <div class="card-body">-->
<!--                        <div class="form-group row">-->
<!--                            <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>-->
<!--                            <div class="col-md-6">-->
<!--                                <input id="name" type="text" :class="[getRegisterErrors.name ? 'is-invalid' : '']" class="form-control" v-model="name" required autocomplete="name">-->
<!--                                <span class="invalid-feedback" role="alert">-->
<!--                                    <strong>{{ getRegisterErrors.name }}</strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group row">-->
<!--                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Адрес</label>-->
<!--                            <div class="col-md-6">-->
<!--                                <input id="email" type="email" :class="[getRegisterErrors.email ? 'is-invalid' : '']" class="form-control" v-model="email"  required autocomplete="email">-->
<!--                                <span class="invalid-feedback" role="alert">-->
<!--                                    <strong>{{ getRegisterErrors.email }}</strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group row">-->
<!--                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>-->
<!--                            <div class="col-md-6">-->
<!--                                <input id="password" type="password" :class="[getRegisterErrors.password ? 'is-invalid' : '']" class="form-control" v-model="password" required autocomplete="new-password">-->
<!--                                <span class="invalid-feedback" role="alert">-->
<!--                                    <strong>{{ getRegisterErrors.password }}</strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group row">-->
<!--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Подтвердите пароль</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" required autocomplete="new-password">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group row mb-0">-->
<!--                            <div class="col-md-6 offset-md-4">-->
<!--                                <button @click="registerUser({name: name,email: email,password: password,password_confirmation: password_confirmation, })" type="submit" class="btn btn-primary">-->
<!--                                    Зарегистрироваться-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-register100">


                        <form class="login100-form register100-form" onclick="return false">
                            <span class="login100-form-title">
                                Регистрация
                            </span>
                            <div class="wrap-input100">
                                <input type="name" class="input100" :class="[getRegisterErrors.name ? 'is-invalid' : '']" v-model="name"  placeholder="Имя">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i v-if="!getRegisterErrors.name" class="fa fa-envelope" aria-hidden="true"></i>
                                    <i v-else class="fa fa-user" style="padding-bottom: 42px" aria-hidden="true"></i>
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ getRegisterErrors.name }}</strong>
                                </span>
                            </div>
                            <div class="wrap-input100">
                                <input type="email" class="input100" :class="[getRegisterErrors.email ? 'is-invalid' : '']" v-model="email"  placeholder="Email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i v-if="!getRegisterErrors.email" class="fa fa-envelope" aria-hidden="true"></i>
                                    <i v-else class="fa fa-envelope" style="padding-bottom: 42px" aria-hidden="true"></i>
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ getRegisterErrors.email }}</strong>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input type="password" class="input100" :class="[getRegisterErrors.password ? 'is-invalid' : '']" v-model="password" placeholder="Пароль">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i v-if="!getRegisterErrors.password" class="fa fa-lock" aria-hidden="true"></i>
                                    <i v-else style="padding-bottom: 22px" class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ getRegisterErrors.password }}</strong>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input type="password" class="input100" v-model="password" placeholder="Подтвердите пароль">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn">
                                    Войти
                                </button>
                            </div>
<!--                            <div class="text-center p-t-12">-->
<!--                                <span class="txt1">-->
<!--                                    Забыли-->
<!--                                </span>-->
<!--                                <a class="txt2" href="#">-->
<!--                                    имя пользователя или пароль?-->
<!--                                </a>-->
<!--                            </div>-->
                            <div class="text-center p-t-136">
                                <a class="txt2" href="#">
                                    Создать новый аккаунт
                                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                                </a>
                            </div>
                        </form>
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
