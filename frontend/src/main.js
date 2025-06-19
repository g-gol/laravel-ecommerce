import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import PrimeVue from 'primevue/config'
import Aura from '@primeuix/themes/aura'
import router from "./router.js";

const app = createApp(App);


app.use(router)
app.use(PrimeVue, {
  theme: {
    preset: Aura,
    options: {
      darkModeSelector: 'light'
    }
  }
})

app.mount('#app')
