import VueRouter from "vue-router";
import Vue from 'vue';
Vue.use(VueRouter);
import store from './store'


import LoginComponent from "./views/auth/LoginComponent";
import RegisterComponent from "./views/auth/RegisterComponent";
import IndexComponent from "./views/index/IndexComponent";
import CreatePostComponent from "./views/posts/CreatePostComponent";
import NotFoundComponent from "./views/NotFoundComponent";
import PostComponent from "./views/posts/PostComponent";
export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '*',
            name: 'notFound',
            component: NotFoundComponent,
            beforeEnter: (to, from, next) => {
                localStorage.setItem('link', 'main');
                    return next({
                        name: 'index'
                    })
            }
        },
        {
            path: '/',
            name: 'index',
            component: IndexComponent,
            beforeEnter: (to, from, next) => {
                localStorage.setItem('link', 'main');
                next()
            }

        },
        {
            path: '/login',
            name: 'login',
            component: LoginComponent,
            beforeEnter: (to, from, next) => {
                if (store.getters.getAuth) {
                    localStorage.setItem('link', 'main');
                    return next({
                        name: 'index'
                    })
                }
                localStorage.removeItem('link')
                next()
            }
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterComponent,
            beforeEnter: (to, from, next) => {
                if (store.getters.getAuth) {
                    localStorage.setItem('link', 'main');
                    return next({
                        name: 'index'
                    })
                }
                localStorage.removeItem('link')
                next()
            }
        },
        {
            path: '/post/create',
            name: 'createPost',
            component: CreatePostComponent,
            beforeEnter: (to, from, next) => {
                if (!store.getters.getAuth) {
                    localStorage.removeItem('link')
                    return next({
                        name: 'login'
                    })
                }
                localStorage.setItem('link', 'post');
                return next()
            }
        },
        {
            path: '/post/:id',
            name: 'post',
            component: PostComponent,

        },


    ],
});
