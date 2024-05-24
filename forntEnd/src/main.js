import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "bootstrap"

export const link = 'http://127.0.0.1:8000';


const app = createApp(App);

app.use(router)

app.mount('#app')