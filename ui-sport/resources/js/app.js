import './bootstrap';
import './toast.js';
import './formatCurrency.js';

// Tom select
window.TomSelect = require('tom-select');

// Axios
import axios from 'axios';

axios.defaults.baseURL = 'http://127.0.0.1:8000/';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.withCredentials = true;

// Vue
import { createApp } from 'vue';
import router from './routes.js';
import App from './layouts/App.vue';

// Gắn vào phần tử có id="app"
createApp(App).use(router).mount('#app');
