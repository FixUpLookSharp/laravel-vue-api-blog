<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-pic js-tilt" data-tilt>
                            <img src="images/img-01.png" alt="IMG">
                        </div>

                        <form class="login100-form" onclick="return false">
                            <span class="login100-form-title">
                                Авторизация
                            </span>
                            <div v-if="getErrorLogin.error" class="alert alert-danger">
                                {{ getErrorLogin.error }}
                            </div>
                            <div class="wrap-input100">
                                <input type="email" class="input100" :class="[getErrorLogin.email ? 'is-invalid' : '']" v-model="email"  placeholder="Email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i v-if="!getErrorLogin.email" class="fa fa-envelope" aria-hidden="true"></i>
                                    <i v-else class="fa fa-envelope" style="padding-bottom: 42px" aria-hidden="true"></i>
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ getErrorLogin.email }}</strong>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                <input type="password" class="input100" :class="[getErrorLogin.password ? 'is-invalid' : '']" v-model="password" placeholder="Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i v-if="!getErrorLogin.password" class="fa fa-lock" aria-hidden="true"></i>
                                    <i v-else style="padding-bottom: 22px" class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ getErrorLogin.password }}</strong>
                                </span>
                            </div>
                            <div class="container-login100-form-btn">
                                <button @click="loginSubmit({email: email, password: password, remember: remember})" type="submit" class="login100-form-btn">
                                    Войти
                                </button>
                            </div>
                            <div class="text-center p-t-12">
                                <span class="txt1">
                                    Забыли
                                </span>
                                <a class="txt2" href="#">
                                    имя пользователя или пароль?
                                </a>
                            </div>
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
        data: function () {
          return {
              email: '',
              password: '',
              remember: false,
          }
        },
        computed: {
            ...mapGetters({
                getAuthStatus: 'getAuthStatus',
                getErrorLogin: 'getErrorLogin'
            })
        },
        mounted() {
        },
        methods: {
            ...mapActions({
                loginSubmit: 'loginSubmit'
            })
        }

    }
</script>

<style scoped>

</style>
