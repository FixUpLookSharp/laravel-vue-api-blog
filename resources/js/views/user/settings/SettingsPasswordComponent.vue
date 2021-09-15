<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <div class="my-4">
                    <layout-menu-settings-component></layout-menu-settings-component>
                    <div>
                        <div v-if="statusPassword" class="alert-success mb-1">Пароль успешно изменен</div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Текущий пароль</label>
                                    <input type="password" v-model="current_password" class="form-control" :class="[errorCurrentPassword ? 'is-invalid' : '']"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errorCurrentPassword }}</strong>
                                     </span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Новый пароль</label>
                                    <input type="password" v-model="new_password" id="password" class="form-control" :class="[errorNewPassword ? 'is-invalid' : '']"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errorNewPassword }}</strong>
                                    </span>
                                    <div v-if="complexityPassword.status">Пароль: <span class="badge mt-1" :class="[complexityPassword.status ? complexityPassword.color : '']">{{ complexityPassword.password }}</span></div>
                                </div>
                                <div class="form-group">
                                    <label>Подтвердите пароль</label>
                                    <input type="password" v-model="new_password_confirmation"  class="form-control" :class="[errorNewPasswordConfirmation ? 'is-invalid' : '']"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errorNewPasswordConfirmation }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Требования к паролю</p>
                                <p class="small text-muted mb-2">Чтобы создать новый пароль, вы должны соответствовать всем следующим требованиям:</p>
                                <ul class="small text-muted pl-4 mb-0">
                                    <li>Должен состоять из латинских букв, верхнего и нижниго регистра</li>
                                    <li>Минимум 8 символов</li>
                                    <li>Хотя бы одно число</li>
                                    <li>Не может быть таким же, как предыдущий пароль</li>
                                    <li>Пример: <span class="example-password">priMeR123</span></li>
                                </ul>
                            </div>
                        </div>
                        <button @click="changePassword({new_password: new_password, current_password: current_password, new_password_confirmation: new_password_confirmation
                        })" type="submit" class="btn btn-primary">Сохранить пароль</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from 'vuex'
    import LayoutMenuSettingsComponent from "./LayoutMenuSettingsComponent";
    export default {
        components: {LayoutMenuSettingsComponent},
        data() {
          return {
              new_password: null,
              current_password: null,
              new_password_confirmation: null,
              statusPassword: false,
              dataPasswordStatus: {
                  status: false,
                  password: '',
                  color: '',
              },

          }
        },
        computed: {
            ...mapGetters({
                errorCurrentPassword: 'getErrorCurrentPassword',
                errorNewPassword: 'getErrorNewPassword',
                errorNewPasswordConfirmation: 'getErrorNewPasswordConfirmation',
                complexityPassword: 'getComplexityPassword'
            })
        },
        watch: {
            new_password: function (password) {
                this.updateErrorNewPassword(null)
                this.checkPassword(password)
                if (!password) {
                    this.updateComplexityPassword(this.dataPasswordStatus)
                }
            },
            current_password: function (e) {
                this.updateErrorCurrentPassword(null)
            },
            new_password_confirmation: function (e) {
                this.updateErrorNewPasswordConfirmation(null)
            },

        },
        methods: {
            ...mapActions({
                checkPassword: 'checkPassword'
            }),
            ...mapMutations({
                updateErrorCurrentPassword: 'updateErrorCurrentPassword',
                updateErrorNewPassword: 'updateErrorNewPassword',
                updateErrorNewPasswordConfirmation: 'updateErrorNewPasswordConfirmation',
                updateComplexityPassword: 'updateComplexityPassword'
            }),
            async changePassword(data) {
               await axios({
                    method: 'post',
                    url: '/api/V1/user/change-password',
                    data: {
                        new_password: data.new_password,
                        current_password: data.current_password,
                        new_password_confirmation: data.new_password_confirmation
                    }
                }).then((response) => {
                    this.statusPassword = response.data.status
                    this.new_password = ''
                    this.current_password =  ''
                    this.new_password_confirmation = ''

                }).catch(error => {
                   this.statusPassword = false

                   var current_password, new_password, new_password_confirmation

                    current_password = error.response.data.errors.current_password ? error.response.data.errors.current_password[0] : null
                    new_password = error.response.data.errors.new_password ? error.response.data.errors.new_password[0] : null
                    new_password_confirmation = error.response.data.errors.new_password_confirmation ? error.response.data.errors.new_password_confirmation[0] : null

                    this.updateErrorCurrentPassword(current_password)
                    this.updateErrorNewPassword(new_password)
                    this.updateErrorNewPasswordConfirmation(new_password_confirmation)
                })
            },
        }

    }
</script>

<style scoped>
    .example-password {
        color: #0ba360;
    }
    .complexity-password {
        width: 100%;
        border-radius: 100px;
    }
    .text-p {
        font-size: 15px;
    }
    .red {
        background-color: #cb3333;
        color: whitesmoke;
    }
    .yellow {
        background-color: #e0e066;
        color: whitesmoke;
    }
    .green {
        background-color: #0ba360;
        color: whitesmoke;
    }
</style>
