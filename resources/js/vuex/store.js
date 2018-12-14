import Vue from 'vue'
import Vuex from 'vuex'
/**
 * Container de Gestão de estados!
 * Modularizar os estados.
 */


//importar arquivos proprios deve ser uma linha depois das demais!
import Preloader from './modules/preloader/preloader'
import Materials from './modules/materials/materials'
import TipoMaterials from './modules/tipo_materials/tipo_materials'
import FormaFarmaceuticas from './modules/forma_farmaceuticas/forma_farmaceuticas'
import Branches from './modules/branches/branches'
import Fornecedors from './modules/fornecedores/fornecedores'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        // Incluir e dá um aliais para o modulo.,
        preloader: Preloader,
        materials: Materials,
        tipo_materials: TipoMaterials,
        forma_farmaceuticas: FormaFarmaceuticas,
        branches: Branches,
        fornecedors: Fornecedors,
    }
})

export default store
