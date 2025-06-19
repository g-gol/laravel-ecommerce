import {createRouter, createWebHistory} from "vue-router"
import Register from "./features/auth/Register.vue";
import Home from "./features/home/Home.vue";
import Login from "./features/auth/Login.vue";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {guestOnly: true}
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: {guestOnly: true}
    }
]

export default createRouter({
    history: createWebHistory('/'),
    routes
})