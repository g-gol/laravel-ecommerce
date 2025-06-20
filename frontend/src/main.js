import {createApp} from 'vue'
import './style.css'
import App from './App.vue'
import PrimeVue from 'primevue/config'
import Aura from '@primeuix/themes/aura'
import router from "./router.js";
import {createPinia} from "pinia";
import useUserStore from "./stores/user.js";

const app = createApp(App)
const pinia = createPinia()


app.use(pinia)
app.use(router)

const userStore = useUserStore()
router.beforeEach(async (to, from, next) => {
    try {
        if (!userStore.user) {
            await userStore.fetchUser()
        }
        if (to.meta.guestOnly) {
            return next('/')
        }
    } catch (err) {
        if (to.meta.requiresAuth) {
            return next('/login')
        }
    }
    return next()
})

app.use(PrimeVue, {
    theme: {
        preset: Aura,
        options: {
            darkModeSelector: 'light'
        }
    }
})

app.mount('#app')
