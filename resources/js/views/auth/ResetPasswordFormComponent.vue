<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-register100">
                        <div class="login100-form register100-form">
                            <div v-if="error_message" class="alert alert-danger text-center">
                                {{ error_message }}
                            </div>
                            <span class="login100-form-title">
                                Новый пароль
                            </span>
                            <div class="wrap-input100">
                                <input type="email" class="input100" v-model="email"  placeholder="user@example.com">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope"  aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input type="password" class="input100" :class="[error_password ? 'is-invalid' : '']" v-model="password" placeholder="Пароль">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i v-if="!error_password" class="fa fa-lock" aria-hidden="true"></i>
                                    <i v-else style="padding-bottom: 22px" class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ error_password }}</strong>
                                </span>
                            </div>
                            <div class="mb-1" v-if="complexityPassword.status">Пароль: <span class="badge mt-1" :class="[complexityPassword.status ? complexityPassword.color : '']">{{ complexityPassword.password }}</span></div>
                            <div class="mb-2" v-if="complexityPassword.status">Пример: <span class="badge mt-1 badge-success">GoOdPassWord123</span></div>
                            <div class="wrap-input100 validate-input">
                                <input type="password" class="input100" v-model="password_confirmation" placeholder="Подтвердите пароль">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="container-login100-form-btn">
                                <button @click="resetPassword" type="submit" class="login100-form-btn">
                                    Обновить пароль
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
    import {mapMutations, mapGetters, mapActions} from 'vuex'
    export default {
        data() {
            return {
                token: null,
                email: null,
                password: null,
                password_confirmation: null,
                error_password: null,
                error_message: false,
                dataPasswordStatus: {
                    status: false,
                    password: '',
                    color: '',
                },
            }
        },
        computed: {
            ...mapGetters({
                complexityPassword: 'getComplexityPassword'
            })
        },
        watch: {
            password: function (password) {
                this.error_password = null
                this.checkPassword(password)
                if (!password) {
                    this.updateComplexityPassword(this.dataPasswordStatus)
                }
            },
        },
        mounted() {
            this.token = this.$route.params.token;
        },
        methods: {
            ...mapActions({
                checkPassword: 'checkPassword'
            }),
            ...mapMutations({
                updateResetSuccess: 'updateResetSuccess',
                updateComplexityPassword: 'updateComplexityPassword'

            }),
           async resetPassword() {
               await axios.post("/api/auth/reset/password", {
                    token: this.token,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then(response => {
                        if (response.data.status) {
                            this.updateResetSuccess(true)
                            this.$router.push({name: 'login'})
                        }
                        this.error_message = response.data.message
                    }, error => {
                       let new_password = error.response.data.errors.password ? error.response.data.errors.password[0] : null
                        this.error_password = new_password
                    });
            }
        }
    }
</script>

<style scoped>

</style>
