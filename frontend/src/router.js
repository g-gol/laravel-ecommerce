import {createRouter, createWebHistory} from "vue-router"
import Register from "./features/auth/Register.vue";
import Home from "./features/home/Home.vue";
import Login from "./features/auth/Login.vue";
import DefaultLayout from "./components/DefaultLayout.vue";
import ProductShow from "./features/products/ProductShow.vue";
import CartShow from "./features/cart/CartShow.vue";

const routes = [
    {
        path: '/',
        component: DefaultLayout,
        meta: {guestOnly: false},
        children: [
            {
                path: '',
                name: 'Home',
                component: Home
            },
            {
                path: '/products/:id',
                name: 'ProductShow',
                component: ProductShow
            },
            {
                path: '/cart',
                name: 'CartShow',
                component: CartShow
            }
        ]
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