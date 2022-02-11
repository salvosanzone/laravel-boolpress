// importo axios per fare la chiamata 
window.axios = require('axios');

window.Vue = require('vue');


// qui importo
import App from './components/App.vue';
import router from './routes';

const app = new Vue({
    el: '#app',
    router,
    render: h=> h(App)
});
