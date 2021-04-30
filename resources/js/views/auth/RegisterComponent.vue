<template>
    <div class="container">
        <div class="row justify-content-center">
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
                                <input type="password" class="input100" v-model="password_confirmation" placeholder="Подтвердите пароль">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="container-login100-form-btn">
                                <button @click="registerUser({name: name,email: email,password: password,password_confirmation: password_confirmation, })" type="submit" class="login100-form-btn">
                                    Зарегистрироваться
                                </button>
                            </div>
                            <div class="text-center p-t-136 txt2">
                                    У вас уже есть аккаунт?<br>
                                    <router-link class="txt2" :to="{name: 'login'}">Войти</router-link>
                                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
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
