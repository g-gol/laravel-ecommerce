import {createApp} from 'vue'
import './style.css'
import App from './App.vue'
import PrimeVue from 'primevue/config'
import 'primeicons/primeicons.css'
import router from "./router.js";
import {createPinia} from "pinia";
import useUserStore from "./stores/user.js";
import Noir from "./theme.js";

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
        preset: Noir,
        options: {
            darkModeSelector: false || 'none',
            cssLayer: {
                name: 'primevue',
                order: 'theme, base, primevue'
            }
        }
    }
})

app.mount('#app')
