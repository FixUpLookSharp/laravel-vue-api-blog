
require('./bootstrap');

import Vue from 'vue';
import store from './store'
import router from "./router";

import { Swiper as SwiperClass, Pagination, Mousewheel, Autoplay, Navigation } from 'swiper/swiper.esm'
import getAwesomeSwiper from 'vue-awesome-swiper/dist/exporter'
SwiperClass.use([Pagination, Mousewheel, Autoplay, Navigation])
Vue.use(getAwesomeSwiper(SwiperClass))
const { Swiper, SwiperSlide } = getAwesomeSwiper(SwiperClass)
import 'swiper/swiper-bundle.css'

import i18n from './i18n'

require('./store/subscriber') //импорт подписчика
axios.default.baseURL = 'http://newblog.test/';


//header
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
//footer
Vue.component('footer-component', require('./components/FooterComponent.vue').default);

store.dispatch('attemptUser', localStorage.getItem('token')).then(() => {
    const app = new Vue({
        el: '#app',
        router,
        store,
        i18n
    });
});






