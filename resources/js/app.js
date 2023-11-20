import './bootstrap';
// app.js

import { createApp } from 'vue'

import Register from './Auth/Register.vue';
import Login from './Auth/Login.vue';

createApp(Register).mount("#app")
