require('./bootstrap');
window.Vue = require('vue');

import Snotify from 'vue-snotify'
import router from './routes/routers'
import store from './vuex/store'

//Configurar o snotjfy
Vue.use(Snotify, {toast: {showProgressBar: false}})

/**
 * Declaração de componetes globais!!
 *
 */
Vue.component('admin-component', require('./components/admin/AdminComponent'))
Vue.component('preloader-component', require('./components/layouts/PreloaderComponent'))

const app = new Vue({
    router,
    store,
    el: '#app'
});
// carregando essas categorias no start do app!
store.dispatch('actionLoadFormaFarmaceuticas')
store.dispatch('actionLoadTipoMaterials')
