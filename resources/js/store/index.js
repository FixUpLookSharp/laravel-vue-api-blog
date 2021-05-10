import Vue from 'vue'
import Vuex from 'vuex'
import auth from "./modules/auth/auth";
import register from "./modules/auth/register";
import helpers from "./modules/helpers";
import login from "./modules/auth/login";
import categories from "./modules/index/categories";
import createPost from "./modules/posts/createPost";
import post from "./modules/posts/post";
import topPost from "./modules/index/topPost";
Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        register,
        helpers,
        login,
        createPost,
        post,
        categories,
        topPost
    }
})
