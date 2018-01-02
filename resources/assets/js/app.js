// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import ElementUI from 'element-ui';
import server from './config/api'
import Vuex from 'vuex'
import 'element-ui/lib/theme-chalk/index.css'


Vue.config.productionTip = true
Vue.prototype.axios = axios
Vue.prototype.$http = axios

Vue.prototype.ApiServer = server

Vue.use(ElementUI)


Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        isLogin: false,
        manager: {},
        access_token: ''
    },
    mutations: {
        login(state) {
            state.isLogin = true;
        },
        logout(state) {
            state.isLogin = false;
            state.manager = {};
        },
        setManager(state, user) {
            state.manager = user;
        }
    }
})

//全局钩子
router.beforeEach((to, from, next) => {

    if (parseInt(localStorage.isLogin)) {
        store.commit("login")
        store.commit("setManager", localStorage.manager)
        next()
    } else {
        //判断该路由是否需要登录权限
        if (to.meta.requiresAuth) {

            //判断全局状态
            if (!store.state.isLogin) {
                next({
                    path: '/login',
                    query: {redirect: to.fullPath}  // 将跳转的路由path作为参数，登录成功后跳转到该路由
                })
            } else {
                next();
            }

        } else {
            next();
        }
    }

})

/* eslint-disable no-new */
new Vue({
    store,
    el: '#app',
    router,
    template: '<App/>',
    components: {App}
})

