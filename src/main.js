import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import RadButton from './components/global/RadButton.vue';

export const link = 'http://127.0.0.1:8000';


const app = createApp(App);
app.component('RadButton',RadButton)
app.use(router)

app.mount('#app')
