// Bootstrap
require('./bootstrap');

// Toast Message
require('./globalApp');

// jquery
require('../../node_modules/jquery/dist/jquery');
require('../../node_modules/jquery/dist/jquery.slim');

//Chart
require('chart.js');

// Tom select
import TomSelect from 'tom-select/dist/js/tom-select.base.js';
import virtual_scroll from 'tom-select/plugins/virtual_scroll/plugin.js';

// Đăng ký plugin thủ công
TomSelect.define('virtual_scroll', virtual_scroll);

window.TomSelect = TomSelect;

// Vue
import { createApp } from 'vue';
import Welcome from './components/Welcome.vue';

const app = createApp({});

// Register component
app.component('Welcome', Welcome);

// Gắn vào phần tử có id="app"
app.mount('#app');
