import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
import login from "./components/auth/login.vue";
import register from "./components/auth/register.vue";
import about from "./components/auth/about.vue";
import user from "./components/user.vue";
 
const router = new VueRouter({
    mode: "history",
    routes: [
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
            path: "/about",
            name: "about",
            component: about,
            meta: { authOnly: true }
        },
        {
            path: "/:user_name",
            name: "user",
            component: user
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
            next("/about");
        } else {
            next();
        }
    } else {
        next();
    }
});
 
export default router;