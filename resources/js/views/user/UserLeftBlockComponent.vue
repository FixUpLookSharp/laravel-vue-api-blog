<template>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <img :src="prefixUrlPhoto + user.photo" class="rounded-circle p-1" :class="[user.isOnlineBool ? 'bg-success' : 'bg-primary']" width="150" height="150">
                    <div class="mt-3">
                        <h4>{{ user.name }}</h4>
                        <p class=" mb-1" :class="user.role.name">{{ $t(user.role.name) }}</p>
                        <p class="text-muted font-size-sm">{{ user.nickname }}</p>
                        <p v-if="user.is_banned" class="blockUser font-size-sm">Заблокирован</p>
                        <div v-if="auth && user.id != auth.id">
                            <button  v-if="auth.role_id == 3 && !user.is_banned" @click="show=true" class="btn btn-outline-danger">Заблокировать</button>
                            <button v-if="auth.role_id == 3 && user.is_banned" :disabled="disabled"  @click="unBlockUser(user.id)" class="btn btn-outline-success">Разблокировать</button>
                            <button class="btn btn-outline-primary" @click="startDialog(user.id)">Начать диалог</button>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <i class="fab fa-vk"><span class="text-icon">vk</span></i>
                        <a v-if="user.vk" class="text-secondary">перейти</a>
                        <span v-else class="text-secondary">отсутствует</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <i class="fab fa-instagram"><span class="text-icon">instagram</span></i>
                        <a v-if="user.instagram" class="text-secondary">перейти</a>
                        <span v-else class="text-secondary">отсутствует</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <i class="fa fa-facebook" aria-hidden="true"><span class="text-icon3">facebook</span></i>
                        <a v-if="user.facebook" class="text-secondary">перейти</a>
                        <span v-else class="text-secondary">отсутствует</span>
                    </li>
                </ul>
            </div>
        </div>
        <b-modal v-model="show"  centered title="Блокировка пользователя">
            <label>Причина блокировки</label>
            <textarea  style="resize: none" v-model="cause" class="form-control" :class="[errorCause ? 'is-invalid' : '']" rows="4"></textarea>
            <span class="invalid-feedback" role="alert">
                <strong>{{ errorCause }}</strong>
            </span>
            <template #modal-footer>
                <b-button @click="show=false" variant="success">Отмена</b-button>
                <b-button :disabled="disabled" @click="blockUser(cause, user.id)" variant="danger">Заблокировать</b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    import moment from "moment";
    export default {
        data() {
            return {
                moment: moment,
                cause: null,
                show: false,
                errorCause: null,
                disabled: false,
                timeout: null,
            }
        },
        computed: {
          ...mapGetters({
              prefixUrlPhoto: 'getPrefixUrlPhoto',
              auth: 'getAuth',
          })
        },
        props: ['user'],
        mounted() {

        },
        methods: {
           async blockUser(cause, user) {
               if (!cause || cause.length < 10) {
                    this.errorCause = 'Поле "Причина" содержать не менее 10 символов'
                    return;
                }
               this.disabled = await true

               this.timeout = await setTimeout(() => {
                   this.disabled = false
               }, 2000)
                await axios({
                    method: 'post',
                    url: '/api/V1/block/' + user,
                    data: {
                        cause: cause
                    }
                }).then((response) => {
                    this.user.is_banned = 1
                    this.cause = null
                    this.show = false
                })
            },
            async unBlockUser(user) {
                this.disabled = await true

                this.timeout = await setTimeout(() => {
                    this.disabled = false
                }, 2000)

                await axios({
                    method: 'post',
                    url: '/api/V1/unblock/' + user,
                }).then((response) => {
                    this.user.is_banned = 0
                    this.cause = null
                })
            },

            async startDialog(user) {
                await axios({
                    method: 'post',
                    url: '/api/V1/chat/store/' + user,
                }).then((response) => {
                    let chatId = response.data
                    this.$router.push('/chat/' + chatId)
                })
            }
        }
    }
</script>

<style scoped>
    .user {
        color: #0a66b7;
    }
    .moderator {
        color: #999918;
    }
    .administrator {
        color: red;
    }
    .blockUser {
        color: red;
    }
    .fa-instagram {
        font-weight: bold;
        font-size: 18px;
        color: rgba(253, 151, 231, 0.97);
    }
    .fa-vk {
        font-weight: bold;
        font-size: 18px;
        color: rgba(161, 151, 253, 0.97);
    }
    .fa-facebook {
        font-weight: bold;
        font-size: 18px;
        color: rgba(161, 151, 253, 0.97);
    }
    .text-icon {
        padding-left: 5px;
        color: black;
    }
    .text-icon3 {
        padding-left: 11px;
        color: black;
    }
</style>
