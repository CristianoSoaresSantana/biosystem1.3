import Vue from 'vue'
import Vuex from 'vuex'
/**
 * Container de Gestão de estados!
 * Modularizar os estados.
 */


//importar arquivos proprios deve ser uma linha depois das demais!
import Filials from './modules/filials/filials'
import Preloader from './modules/preloader/preloader'
import Materials from './modules/materials/materials'
import TipoMaterials from './modules/tipo_materials/tipo_materials'
import FormaFarmaceuticas from './modules/forma_farmaceuticas/forma_farmaceuticas'
import Branches from './modules/branches/branches'


Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        // Incluir e dá um aliais para o modulo.
        filials: Filials,
        preloader: Preloader,
        materials: Materials,
        tipo_materials: TipoMaterials,
        forma_farmaceuticas: FormaFarmaceuticas,
        branches: Branches,
    }
})

export default store
