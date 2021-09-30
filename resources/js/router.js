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
import CategoryComponent from "./views/categories/CategoryComponent";
import UserInfoComponent from "./views/user/UserInfoComponent";
import AllUserComponent from "./views/users/AllUserComponent";
import SettingInfoComponent from "./views/user/settings/SettingInfoComponent";
import SettingsPasswordComponent from "./views/user/settings/SettingsPasswordComponent";
import AllPostsUserComponent from "./views/user/posts/AllPostsUserComponent";
import ForgotPasswordComponent from "./views/auth/ForgotPasswordComponent";
import ResetPasswordFormComponent from "./views/auth/ResetPasswordFormComponent";
import GamesComponent from "./views/games/GamesComponent";
import TicTacToeComponent from "./views/games/TicTacToeComponent";
import ChatComponent from "./views/chat/ChatComponent";

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '*',
            name: 'notFound',
            component: NotFoundComponent,
            meta: {link: 'notFound'}
            // beforeEnter: (to, from, next) => {
            //     localStorage.setItem('link', 'main');
            //         return next({
            //             name: 'index'
            //         })
            // }
        },
        {
            path: '/',
            name: 'index',
            component: IndexComponent,
            meta: {link: 'index'},
            beforeEnter: (to, from, next) => {
                localStorage.setItem('link', 'main');
                next()
            },


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
        {
            path: '/category/:id',
            name: 'category',
            component: CategoryComponent,
        },
        {
            path: '/account/:id/info',
            name: 'user',
            component: UserInfoComponent,

        },
        {
            path: '/users',
            name: 'users',
            component: AllUserComponent,
        },
        {
            path: '/user/settings',
            name: 'userSettings',
            meta: {link: 'settings'},
            component: SettingInfoComponent,
            beforeEnter: (to, from, next) => {
                if (!store.getters.getAuth) {
                    return next({
                        name: 'login'
                    })
                }
                localStorage.removeItem('link')
                next()
            }
        },
        {
            path: '/user/change/password',
            name: 'userChangePassword',
            meta: {link: 'password'},
            component: SettingsPasswordComponent,
            beforeEnter: (to, from, next) => {
                if (!store.getters.getAuth) {
                    return next({
                        name: 'login'
                    })
                }
                localStorage.removeItem('link')
                next()
            }
        },
        {
            path: '/user/my-posts',
            name: 'userPosts',
            meta: {link: 'userPosts'},
            component: AllPostsUserComponent,
            beforeEnter: (to, from, next) => {
                if (!store.getters.getAuth) {
                    return next({
                        name: 'login'
                    })
                }
                localStorage.removeItem('link')
                next()
            }
        },

        {
            path: '/reset-password',
            name: 'reset-password',
            component: ForgotPasswordComponent,
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
            path: '/reset-password/:token',
            name: 'reset-password-form',
            component: ResetPasswordFormComponent,
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
            path: '/games',
            name: 'games',
            component: GamesComponent,
            beforeEnter: (to, from, next) => {
                if (!store.getters.getAuth) {
                    return next({
                        name: 'login'
                    })
                }
                next()
            }
        },
        {
            path: '/games/tic-tac-toe',
            name: 'tic-tac-toe',
            component: TicTacToeComponent,
            beforeEnter: (to, from, next) => {
                if (!store.getters.getAuth) {
                    return next({
                        name: 'login'
                    })
                }
                next()
            }
        },
        {
            path: '/chat',
            name: 'chat-all',
            component: ChatComponent,
            beforeEnter: (to, from, next) => {
                if (!store.getters.getAuth) {
                    return next({
                        name: 'login'
                    })
                }
                next()
            }
        },
        {
            path: '/chat/:chat',
            name: 'chat',
            component: ChatComponent,
            beforeEnter: (to, from, next) => {
                if (!store.getters.getAuth) {
                    return next({
                        name: 'login'
                    })
                }
                next()
            }
        },


    ],
});
