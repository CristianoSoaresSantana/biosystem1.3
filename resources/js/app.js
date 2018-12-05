require('./bootstrap');

window.Vue = require('vue');

import router from './routes/routers'
import store from './vuex/store'
/**
 * Declaração de componetes globais!!
 * 
 */


const app = new Vue({
    router,
    store,
    el: '#app'
});
