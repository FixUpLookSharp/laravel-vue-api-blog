import VueI18n from 'vue-i18n'
import Vue from 'vue';
import ru from './lang/ru.json'
Vue.use(VueI18n)


export default new VueI18n({
    locale: 'ru',
    messages: {
        ru: ru
    }
})
