import axios from 'axios'
// importar url_base da group da api
import { URL_BASE } from '../../../config/config'
import { resolve } from "url";
import { rejects } from "assert";

// resource do crud
const RESOURCE = 'filials'

export default {
    actionLoadBranches (context) {
        context.commit('PRELOADER', true)

        axios.get(`${URL_BASE}${RESOURCE}`)
            .then(response => context.commit('MUTATION_LOAD_FILIALS', response.data))
            .catch(errors => console.log(errors))
            .finally(() => context.commit('PRELOADER', false))
    },

    actionLoadBranche (context, id) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.get(`${URL_BASE}${RESOURCE}/${id}`)
                .then(response => resolve(response.data))
                .catch(errors => reject(errors))
                .finally(context.commit('PRELOADER', false))
        })
    },

    storeBranche (context, params) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) =>{
            axios.post(`${URL_BASE}${RESOURCE}`, params)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                .finally(() => context.commit('PRELOADER', false))
        })
    },

    updateBranche (context, params) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.put(`${URL_BASE}${RESOURCE}/${params.id}`, params)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                .finally(() => context.commit('PRELOADER', false))
        })
    },

    destroyBranche (context, id) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.delete(`${URL_BASE}${RESOURCE}/${id}`)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                // recurso comentado para o preloader ser chamado ao recarregar table.
                .finally(() => context.commit('PRELOADER', false))
        })
    },
}
