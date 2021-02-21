import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);

import root from "./components/root.vue";
import login from "./components/auth/login.vue";
import register from "./components/auth/register.vue";
import account from "./components/auth/account.vue";
import user from "./components/user.vue";
import create from "./components/storage/create.vue";
import storage from "./components/storage/storage.vue";
import notfound from "./components/notfound.vue";
 
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "root",
            component: root,
        },
        {
            path: "/login",
            name: "login",
            component: login,
            meta: { guestOnly: true }
        },
        {
            path: "/register",
            name: "register",
            component: register,
            meta: { guestOnly: true }
        },
        {
            path: "/account",
            name: "account",
            component: account,
            meta: { authOnly: true }
        },
        {
            path: "/create",
            name: "create",
            component: create,
            meta: { authOnly: true }
        },
        {
            path: "/:user_id",
            name: "user",
            component: user
        },
        {
            path: "/:user_id/:storage_name",
            name: "storage",
            component: storage
        },
        {
            path: "/*",
            name: "notfound",
            component: notfound
        }
    ]
});
 
function isLoggedIn() {
    return localStorage.getItem("auth");
}
 
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authOnly)) {
        if (!isLoggedIn()) {
            next("/login");
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        if (isLoggedIn()) {
            next("/account");
        } else {
            next();
        }
    } else {
        next();
    }
});
 
export default router;