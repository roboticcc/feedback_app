import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import Navbar from './components/Navbar.vue';
import 'bootstrap/dist/css/bootstrap.min.css'

const app = createApp(App);
app.component('Navbar', Navbar);
app.use(router);
app.use(store);
app.mount('#app');
