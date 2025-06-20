import {createApp} from 'vue'
import './style.css'
import App from './App.vue'
import PrimeVue from 'primevue/config'
import Aura from '@primeuix/themes/aura'
import router from "./router.js";
import {createPinia} from "pinia";
import useUserStore from "./stores/user.js";
import {definePreset} from "@primeuix/themes";

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


const stylePreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: '{slate.50}',
            100: '{slate.100}',
            200: '{slate.200}',
            300: '{slate.300}',
            400: '{slate.400}',
            500: '{slate.500}',
            600: '{slate.600}',
            700: '{slate.700}',
            800: '{slate.800}',
            900: '{slate.900}',
            950: '{slate.950}'
        }
    }
});

app.use(PrimeVue, {
    theme: {
        preset: stylePreset,
        options: {
            darkModeSelector: false || 'none',
        }
    }
})

app.mount('#app')
