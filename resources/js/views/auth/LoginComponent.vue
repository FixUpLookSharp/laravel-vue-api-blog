<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">Логин</div>
                    <div v-if="getErrorLogin.error" class="alert alert-danger">
                        {{ getErrorLogin.error }}
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">E-Mail Адрес</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" :class="[getErrorLogin.email ? 'is-invalid' : '']" v-model="email"  required autocomplete="email">
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ getErrorLogin.email }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" :class="[getErrorLogin.password ? 'is-invalid' : '']" v-model="password" required autocomplete="current-password">
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ getErrorLogin.password }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  v-model="remember">
                                    <label class="form-check-label">Запомнить</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button @click="loginSubmit({email: email, password: password, remember: remember})" type="submit" class="btn btn-primary">
                                    Войти
                                </button>
                                <a class="btn btn-link">
                                    Забыли пороль?
                                </a>
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
