import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue';
import Dashboard from './pages/Dashboard.vue';

const app = createApp(Dashboard, {
    fruits: JSON.parse(document.getElementById('app').dataset.fruits)
});

app.mount('#app');
