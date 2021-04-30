import VueRouter from "vue-router";
import Vue from 'vue';
Vue.use(VueRouter);
import store from './store'


import LoginComponent from "./views/auth/LoginComponent";
import RegisterComponent from "./views/auth/RegisterComponent";
import IndexComponent from "./components/IndexComponent";
import CreatePostComponent from "./views/posts/CreatePostComponent";
export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: LoginComponent,
            beforeEnter: (to, from, next) => {
                if (store.getters.getAuth) {
                    return next({
                        name: 'index'
                    })
                }
                next()
            }
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterComponent,
            beforeEnter: (to, from, next) => {
                if (store.getters.getAuth) {
                    return next({
                        name: 'index'
                    })
                }
                next()
            }
        },
        {
            path: '/create/post',
            name: 'createPost',
            component: CreatePostComponent,
            beforeEnter: (to, from, next) => {
                if (store.getters.getAuth) {
                    return next({
                        name: 'index'
                    })
                }
                next()
            }
        },
        {
            path: '/',
            name: 'index',
            component: IndexComponent
        },


    ],
});
