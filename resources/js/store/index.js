import Vue from 'vue'
import Vuex from 'vuex'
import auth from "./modules/auth/auth";
import register from "./modules/auth/register";
import helpers from "./modules/helpers";
import login from "./modules/auth/login";
import categories from "./modules/header/categories";
import createPost from "./modules/posts/createPost";
import post from "./modules/posts/post";
import topPost from "./modules/index/topPost";
import nav2 from "./modules/header/nav2";
import comments from "./modules/posts/comments"
import randomPost from "./modules/index/randomPost";
import topWeek from "./modules/index/topWeek";
import userInfo from  "./modules/user/userInfo";
import search from "./modules/search/search";
import categorySearch from "./modules/search/categorySearch";
import footer from "./modules/footer/footer";
import userSettings from "./modules/user/userSettings";
import changePassword from "./modules/user/changePassword";
import changeUser from "./modules/user/changeUser";
import userPosts from "./modules/user/userPosts";
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
        topPost,
        nav2,
        comments,
        randomPost,
        topWeek,
        userInfo,
        search,
        categorySearch,
        footer,
        userSettings,
        changePassword,
        changeUser,
        userPosts
    }
})
