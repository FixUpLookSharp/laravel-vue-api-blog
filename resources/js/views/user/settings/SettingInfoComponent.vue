<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <div class="my-4">
                    <layout-menu-settings-component></layout-menu-settings-component>
                    <div>
                        <div class="row mt-5 align-items-center">
                            <div class="col-md-3 text-center mb-5">
                                <div class="avatar avatar-xl">
                                    <img :src="prefixUrlPhoto + auth.photo" class="avatar-img rounded" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7 mb-1">
                                        <h4 class="mb-1">{{ auth.name }}</h4>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <p class="text-muted">
                                            Чтобы обновить аватар, после выбора файла нажмите «Сохранить» внизу страницы<br>
                                            Разрешенные типы изображений: jpeg, png, gif<br>
                                            Максимальный размер файла: 15 Мб<br>
                                            Не больше 5000 точек по каждой из сторон<br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <b-form-file
                                v-model="photo"
                                placeholder="Выберите файл или перетащите сюда ..."
                                drop-placeholder="Перетащите файл сюда ..."
                                browse-text="Загрузить"
                            ></b-form-file>
                        </div>
                        <hr class="my-4" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Имя</label>
                                <input type="text" class="form-control" :class="[name ? 'is-valid' : '']" v-model="name"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ник</label>
                                <input type="text" class="form-control" :class="[nickname ? 'is-valid' : '']" v-model="nickname"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" :class="[email ? 'is-valid' : '']" v-model="email"/>
                        </div>
                        <div class="form-group">
                            <label>Обо мне</label>
                            <textarea type="text" class="form-control info-text" :class="[info ? 'is-valid' : '']" rows="2" v-model="info"/>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Адрес</label>
                                <input type="text" class="form-control" :class="[address ? 'is-valid' : '']" v-model="address"/>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Телефон</label>
                                <input type="text" class="form-control" :class="[phone ? 'is-valid' : '']" v-model="phone" v-mask="'#-###-###-##-##'"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Вконтакте</label>
                                <input type="text" class="form-control" :class="[vk ? 'is-valid' : '']" v-model="vk"/>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Фейсбук</label>
                                <input type="text" class="form-control" :class="[facebook ? 'is-valid' : '']" v-model="facebook"/>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Инстаграм</label>
                                <input type="text" class="form-control" :class="[instagram ? 'is-valid' : '']" v-model="instagram"/>
                            </div>
                        </div>
                        <button @click="changeUser({
                        photo: photo,
                        name: name,
                        email: email,
                        info: info,
                        address: address,
                        phone: phone,
                        vk: vk,
                        facebook: facebook,
                        nickname: nickname,
                        instagram: instagram,
                         })" type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapMutations} from 'vuex'
    import {mask} from 'vue-the-mask'
    import LayoutMenuSettingsComponent from "./LayoutMenuSettingsComponent";
    export default {
        components: {
            LayoutMenuSettingsComponent,
        },
        directives: {mask},
        data() {
            return {
                name: null,
                email: null,
                nickname: null,
                info: null,
                address: null,
                phone: null,
                vk: null,
                facebook: null,
                instagram: null,
                photo: null
            }
        },
        computed: {
            ...mapGetters({
                auth: 'getAuth',
                prefixUrlPhoto: 'getPrefixUrlPhoto'
            })
        },
        created() {
            this.name = this.auth.name
            this.email = this.auth.email
            this.nickname = this.auth.nickname
            this.info = this.auth.info ? this.auth.info : ''
            this.address = this.auth.address ? this.auth.address : ''
            this.phone = this.auth.phone ? this.auth.phone : ''
            this.vk = this.auth.vk ? this.auth.vk : ''
            this.facebook = this.auth.facebook ? this.auth.facebook : ''
            this.instagram = this.auth.instagram ? this.auth.instagram : ''

        },
        methods: {
            ...mapActions({
                changeUser: 'changeUser'
            }),
        }
    }
</script>

<style scoped>
    .info-text {
        resize: none;
    }
</style>
