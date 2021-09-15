<template>
    <div class="container">
        <div class="alert alert-danger mt-5">
            Вы заблокированы
        </div>
        <div style="margin-bottom: 10px" class="row">
            <div class="col-lg-12">
                <h4>Причина блокировки</h4>
                <p>{{ auth.cause }}</p>
                <span>Для дальнейших разбирательств свяжитесь с администрацией</span>
            </div>
        </div>

        <div class="row mb-5">
            <div v-if="success" class="alert alert-success col-lg-12">
                Запрос отправлен, ответ придет на ваш электронный адрес, в течение 48 часов!
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Ваш E-Mail</label>
                    <input type="email" v-model="email" class="form-control" :class="[errors.email ? 'is-invalid' : '']" placeholder="name@example.com">
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ errors.email }}</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label>Объяснение</label>
                    <textarea class="form-control" :class="[errors.explanation ? 'is-invalid' : '']" v-model="explanation" rows="3"></textarea>
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ errors.explanation }}</strong>
                    </span>
                </div>
                <input v-if="!sendSuccess" @click="explanationUser({email:email, explanation:explanation})" type="submit" class="btn btn-primary" value="Отправить">
                <div v-if="sendSuccess" class="alert alert-secondary col-lg-12">
                    {{ message }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        data() {
            return {
                email: '',
                explanation: '',
                success: false,
                sendSuccess: false,
                message: '',
                errors: {
                    email: null,
                    explanation: null
                }

            }
        },
        watch: {
            email: function (e) {
                this.errors.email = null
            },
            explanation: function () {
                this.errors.explanation = null
            }
        },
        computed: {
          ...mapGetters({
              auth: 'getAuth'
          })
        },
        methods: {
           async explanationUser(data) {
                await axios({
                    method: 'post',
                    url: '/api/V1/explanation',
                    data: {
                        email: data.email,
                        explanation: data.explanation
                    }
                }).then((response) => {
                    if (response.data.access === false) {
                        this.message = response.data.message
                        this.sendSuccess = true
                        return;
                    }
                    this.success = true
                }).catch(error => {

                    this.errors.email = error.response.data.errors.email ? error.response.data.errors.email[0] : null
                    this.errors.explanation = error.response.data.errors.explanation ? error.response.data.errors.explanation[0] : null
                })
            }
        }
    }
</script>

<style scoped>

</style>
