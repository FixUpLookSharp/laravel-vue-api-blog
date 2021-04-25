import Vue from 'vue'
import Vuex from 'vuex'
import auth from "./modules/auth/auth";
import register from "./modules/auth/register";
import helpers from "./modules/helpers";
import login from "./modules/auth/login";
import index from "./modules";
Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        register,
        helpers,
        login,
        index
    }
})
