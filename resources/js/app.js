require('./bootstrap');

window.Vue = require('vue');

import router from './routes/routers'

/**
 * Declaração de componetes globais!!
 * 
 */


const app = new Vue({
    router,
    el: '#app'
});
