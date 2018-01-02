import Vue from 'vue'
import Router from 'vue-router'

import Login from '../components/login.vue'
import Home from '../components/common/Home.vue'
import index from '../components/Example.vue'
import site from '../components/site.vue'
import message from '../components/message.vue'
import articleCategory from '../components/articleCategory.vue'
import articleDetail from '../components/articleDetail.vue'
import articleContent from '../components/articleContent.vue'
import friendship from '../components/friendship.vue'
import pictureCategory from '../components/pictureCategory.vue'
import picture from '../components/picture.vue'

Vue.use(Router)
/*export default new Router({
 /!*   mode: 'history',*!/
 routes: [
 {
 path: '/hello',
 component: hello
 }
 ]
 })*/


export default new Router({
    routes: [
        {
            path: '/home',
            component: Home,
            name: 'home',
            meta: {requiresAuth: false},
            children: [
                {
                    path: '/index',
                    component: index,
                    meta: {requiresAuth: false}
                }, {
                    path: '/site',
                    component: site,
                    meta: {requiresAuth: false}
                }, {
                    path: '/message',
                    component: message,
                    meta: {requiresAuth: false}
                }, {
                    path: '/articleCategory',
                    component: articleCategory,
                    meta: {requiresAuth: false}
                }, {
                    path: '/articleDetail',
                    component: articleDetail,
                    meta: {requiresAuth: false}
                }, {
                    path: '/articleContent',
                    component: articleContent,
                    meta: {requiresAuth: false}
                }, {
                    path: '/friendship',
                    component: friendship,
                    meta: {requiresAuth: false}
                }, {
                    path: '/pictureCategory',
                    component: pictureCategory,
                    meta: {requiresAuth: false}
                }, {
                    path: '/picture',
                    component: picture,
                    meta: {requiresAuth: false}
                }
            ]
        },
        {
            path: '/login',
            component: Login
        }
    ]
})

