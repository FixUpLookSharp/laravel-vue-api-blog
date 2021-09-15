<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-register100">
                        <form class="login100-form register100-form" onclick="return false">
                            <div v-if="error_message" class="alert alert-danger text-center">
                                {{ error_message }}
                            </div>
                            <div v-if="message" class="alert alert-success text-center">
                                {{ message }}
                            </div>
                            <span class="login100-form-title">
                                Сбросить пароль
                            </span>
                            <div class="wrap-input100">
                                <input type="email" class="input100" v-model="email" :class="[error_email ? 'is-invalid' : '']" placeholder="user@example.com" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i v-if="!error_email" class="fa fa-envelope" aria-hidden="true"></i>
                                    <i v-else-if="error_email && !email" class="fa fa-envelope" style="padding-bottom: 22px" aria-hidden="true"></i>
                                    <i v-else-if="error_email && email" class="fa fa-envelope" style="padding-bottom: 42px" aria-hidden="true"></i>
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ error_email }}</strong>
                                </span>
                            </div>
                            <div class="container-login100-form-btn">
                                <button @click="requestResetPassword" type="submit" class="login100-form-btn">
                                    Обновить пароль
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: null,
                message: null,
                error_email: null,
                error_message: null,
            }
        },
        watch: {
            email: function (e) {
            this.error_email = null
            }
        },
        methods: {
           async requestResetPassword() {
              await axios.post("/api/auth/reset-password", {email: this.email}).then(response => {
                    if (response.data.status) {
                        this.error_message = null
                        this.message = response.data.message
                    } else {
                        this.message = null
                        this.error_message = response.data.message
                    }
                }, error => {
                    let new_email = error.response.data.errors.email ? error.response.data.errors.email[0] : null
                    this.error_email = new_email
                });
            }
        }
    }
</script>

<style scoped>

</style>
