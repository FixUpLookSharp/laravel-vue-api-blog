
require('./bootstrap');

import Vue from 'vue';
import store from './store'
import router from "./router";

// markdown
import 'v-markdown-editor/dist/v-markdown-editor.css';
import Editor from 'v-markdown-editor'
Vue.use(Editor);

//bootstrap vue
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

//carousel
import { Swiper as SwiperClass, Pagination, Mousewheel, Autoplay, Navigation } from 'swiper/swiper.esm'
import getAwesomeSwiper from 'vue-awesome-swiper/dist/exporter'
SwiperClass.use([Pagination, Mousewheel, Autoplay, Navigation])
Vue.use(getAwesomeSwiper(SwiperClass))
const { Swiper, SwiperSlide } = getAwesomeSwiper(SwiperClass)
import 'swiper/swiper-bundle.css'

//lang
import i18n from './i18n'

require('./store/subscriber')
axios.default.baseURL = 'http://newblog.test/';

//header
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
//footer
Vue.component('footer-component', require('./components/FooterComponent.vue').default);

//pagination
Vue.component('paginate-component', require('laravel-vue-pagination'));

store.dispatch('attemptUser', localStorage.getItem('token')).then(() => {
    const app = new Vue({
        el: '#app',
        router,
        store,
        i18n,
    });
});






