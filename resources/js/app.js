require('./bootstrap');
window.Vue = require('vue');

import Snotify from 'vue-snotify'
import router from './routes/routers'
import store from './vuex/store'
import moment from 'moment-timezone'

//Configurar o snotjfy
Vue.use(Snotify, {toast: {showProgressBar: false}})

Vue.use(require('vue-moment'), {
    moment
})

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
store.dispatch('actionLoadBranches')
store.dispatch('setorsLoadIndex')
store.dispatch('forma_pagtosIndex')
store.dispatch('tipo_movimentosIndex')
store.dispatch('fornecedorLoadIndex')
store.dispatch('usuarioLoadIndex')
store.dispatch('clienteLoadIndex')
