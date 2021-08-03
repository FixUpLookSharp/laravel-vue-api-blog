<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
<!--                <h2 class="h3 mb-4 page-title">Settings</h2>-->
                <div class="my-4">
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a @click="settF" class="nav-link active">Профиль</a>
                        </li>
                        <li class="nav-item">
                            <a @click="passF" class="nav-link">Настройки пароля</a>
                        </li>
                    </ul>
                    <setting-info-component v-if="sett"></setting-info-component>
                    <settings-password-component v-else-if="pass"></settings-password-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SettingsPasswordComponent from "./SettingsPasswordComponent";
    import SettingInfoComponent from "./SettingInfoComponent";
    export default {
        data() {
            return {
                pass: false,
                sett: true,
            }
        },
        components: {
            SettingsPasswordComponent,
            SettingInfoComponent
        },
        methods: {
            passF() {
                this.pass = true
                this.sett = false
            },
            settF() {
                this.pass = false
                this.sett = true
            }
        }

    }
</script>

<style scoped>

</style>
