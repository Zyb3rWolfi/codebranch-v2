import { createApp } from 'vue'
import './style.css'
import './input.css'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import 'flowbite'         

axios.defaults.withCredentials = true; // Crucial for cookie-based auth
axios.defaults.withXSFRToken = true; // Crucial for CSRF protection
axios.defaults.baseURL = 'http://127.0.0.1:8000';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createApp(App).use(router).mount('#app')