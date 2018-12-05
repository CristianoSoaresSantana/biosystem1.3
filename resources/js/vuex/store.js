import Vue from 'vue'
import Vuex from 'vuex'
/**
 * Container de Gestão de estados!
 * Modularizar os estados.
 */


//importar arquivos proprios deve ser uma linha depois das demais!
import Filials from './modules/filials/filials'
import Preloader from './modules/preloader/preloader'


Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        // Incluir e dá um aliais para o modulo.
        filials: Filials,
        preloader: Preloader
    }
})

export default store